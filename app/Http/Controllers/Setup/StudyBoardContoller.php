<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyBoardStoreRequest;
use App\Models\ChairPerson;
use App\Models\StudyBoard;
use App\Models\StudyBoardSubject;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class StudyBoardContoller extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function StudyBoardIndex()
    {
        Gate::authorize('study.board.list');
        $data = StudyBoard::all();

        return view('admin.setups.study_board.index', compact('data'));
    }

    public function StudyBoardAdd()
    {
        Gate::authorize('study.board.create');
        return view('admin.setups.study_board.add');
    }

    public function StudyBoardStore(StudyBoardStoreRequest $request)
    {
        Gate::authorize('study.board.create');
        StudyBoard::create($request->prepareData());

        $notification = array(
            'message' => 'New Study Board Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('study.board.index')->with($notification);
    }

    public function StudyBoardEdit($id)
    {
        Gate::authorize('study.board.updation');
        $studyBoardId = decrypt($id);
        $editData = StudyBoard::find($studyBoardId);
        return view('admin.setups.study_board.edit', compact('editData'));
    }

    public function StudyBoardUpdate(StudyBoardStoreRequest $request, $id)
    {
        Gate::authorize('study.board.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Study Board data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('study.board.index')->with($notification);
    }

    public function StudyBoardShow($id)
    {
        Gate::authorize('study.board.show');
        $studyBoardId = decrypt($id);
        $data = StudyBoard::find($studyBoardId);
        $studyBoardSubjects = StudyBoardSubject::where('study_board_id', $studyBoardId)->get();
        $studyBoardChairPerson = ChairPerson::where('study_board_id', $studyBoardId)->where('active_status', 1)->first();
        $studyBoardChairPersonDetails = $this->fetchEmployeeData($studyBoardChairPerson->emp_no);
        //dd($studyBoardChairPersonDetails);
        return view('admin.setups.study_board.show', compact('data', 'studyBoardSubjects','studyBoardChairPerson','studyBoardChairPersonDetails'));
    }

    public function StudyBoardDelete($id)
    {
        Gate::authorize('study.board.delete');
        $studyBoardId = decrypt($id);
        $data = StudyBoard::find($studyBoardId);
        $data->delete();

        $notification = array(
            'message' => 'Study Board Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('study.board.index')->with($notification);
    }

    private function fetchEmployeeData($emp)
    {

        // Make API request to HRMS
        $empDetails = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => 'bf919ee9-09fa-43f5-94d6-3339888f0f5f',
        ])->post('https://hrms.sjp.ac.lk/api/emp/fgs/employee/data/get', ['employee_no' => $emp]);

        // Decode the response to an associative array
        return json_decode($empDetails, true);
    }

}
