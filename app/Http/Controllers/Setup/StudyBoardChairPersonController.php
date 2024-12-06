<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyBoardChairPersonStoreRequest;
use App\Models\ChairPerson;
use App\Models\StudyBoard;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class StudyBoardChairPersonController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function StudyBoardChairPersonIndex()
    {
        Gate::authorize('study.board.chair.person.list');

        // Call the method to get employee data from the HRMS API
        $empData = $this->fetchEmployeeData();

        // Call the method to get study board chairperson details
        $data = $this->getStudyBoardChairPersonDetails($empData);

        return view('admin.setups.study_board_chair_person.index', compact('data'));
    }

    public function StudyBoardChairPersonAdd()
    {
        Gate::authorize('study.board.chair.person.create');

        $studyBoards = StudyBoard::where('study_boards.active_status', 1)
        ->whereDoesntHave('chairPeople', function ($query) {
            $query->where('active_status', 1);
        })->get();

        $empData = $this->acdemicEmployeeData();
        $categories = $this->getCategories([2]);
        $appartmentTypes = $categories->where('category_type_id', '2');
        return view('admin.setups.study_board_chair_person.add', compact('studyBoards','empData','appartmentTypes'));
    }

    public function StudyBoardChairPersonStore(StudyBoardChairPersonStoreRequest $request)
    {
        Gate::authorize('study.board.chair.person.create');
        ChairPerson::create($request->prepareData());

        $notification = array(
            'message' => 'New Study Board Chair Person Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('study.board.chair.person.index')->with($notification);
    }

    public function StudyBoardChairPersonEdit($id)
    {
        Gate::authorize('study.board.chair.person.updation');
        $studyBoardChairPersonId = decrypt($id);
        $studyBoards = StudyBoard::where('active_status', 1)->get();
        $empData = $this->acdemicEmployeeData();
        $categories = $this->getCategories([2]);
        $appartmentTypes = $categories->where('category_type_id', '2');
        $editData = ChairPerson::find($studyBoardChairPersonId);
        return view('admin.setups.study_board_chair_person.edit', compact('editData','studyBoards','empData','appartmentTypes'));
    }

    public function StudyBoardChairPersonUpdate(StudyBoardChairPersonStoreRequest $request, $id)
    {
        Gate::authorize('study.board.chair.person.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Study Board Chair Person data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('study.board.chair.person.index')->with($notification);
    }

    public function StudyBoardChairPersonDelete($id)
    {
        Gate::authorize('study.board.chair.person.delete');
        $studyBoardChairPersonId = decrypt($id);
        $data = ChairPerson::find($studyBoardChairPersonId);
        $data->delete();

        $notification = array(
            'message' => 'Study Board Chair Person Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('study.board.chair.person.index')->with($notification);
    }

    private function fetchEmployeeData()
    {
        $empIDs = ChairPerson::pluck('emp_no');

        // Make API request to HRMS
        $empDetails = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => 'bf919ee9-09fa-43f5-94d6-3339888f0f5f',
        ])->post('https://hrms.sjp.ac.lk/api/emp/fgs/study/board/chair/person/list', ['empIDs' => $empIDs]);

        // Decode the response to an associative array
        return json_decode($empDetails, true);
    }

    private function getStudyBoardChairPersonDetails($empData)
    {
        // Join the chairperson and study board data, map it with the HRMS data
        return ChairPerson::join('study_boards', 'study_boards.id', '=', 'chair_people.study_board_id')
            ->select('chair_people.*', 'study_boards.name')
            ->where('chair_people.active_status', 1)
            ->orderBy('study_board_id')
            ->get()
            ->map(function ($item) use ($empData) {
                $empID = $item['emp_no'];

                $employeeInfo = collect($empData)->firstWhere('employee_no', $empID);

                // Map the additional employee info
                $item['LName'] = $employeeInfo['last_name'] ?? null;
                $item['initial'] = $employeeInfo['initials'] ?? null;
                $item['title'] = $employeeInfo['title'] ?? null;
                $item['department'] = $employeeInfo['department_name'] ?? null;
                $item['status'] = $employeeInfo['employee_status_id'] ?? null;
                $item['email'] = $employeeInfo['email'] ?? null;
                $item['mobile_no'] = $employeeInfo['mobile_no'] ?? null;

                return $item;
            });
    }

    private function acdemicEmployeeData()
    {

        // Make API request to HRMS
        $empDetails = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => 'bf919ee9-09fa-43f5-94d6-3339888f0f5f',
        ])->post('https://hrms.sjp.ac.lk/api/emp/fgs/study/board/chair/person');

        // Decode the response to an associative array
        return json_decode($empDetails, true);
    }
}
