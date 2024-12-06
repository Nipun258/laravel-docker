<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseFeeStoreRequest;
use App\Models\Course;
use App\Models\CourseFees;
use App\Models\IncomeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourseFeeController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function CourseFeeIndex()
    {
        Gate::authorize('course.fee.list');
        $data = Course::all();

        return view('admin.setups.course_fee.index', compact('data'));
    }

    public function CourseFeeShow($id)
    {
        Gate::authorize('course.fee.show');
        $courseId = decrypt($id);
        $courseFees = CourseFees::where('course_code', $courseId)->get();
        $incomeTypes = IncomeType::all();
        $data = Course::find($courseId);

        //dd($studyBoardChairPersonDetails);
        return view('admin.setups.course_fee.show', compact('data', 'courseFees', 'incomeTypes'));
    }

    public function CourseFeeStore(CourseFeeStoreRequest $request)
    {
        Gate::authorize('course.fee.create');

        $data = $request->all();

        if (count($data['reg_year']) > 0) {

            foreach ($data['reg_year'] as $index => $reg_year) {
                CourseFees::create([
                    'course_code' => $data['course_code'],
                    'reg_year' => $data['reg_year'][$index],
                    'batch' => $data['batch'][$index],
                    'intake' => $data['intake'][$index],
                    'pay_income_type_id' => $data['pay_income_type_id'][$index],
                    'amount' => $data['amount'][$index],
                    'created_emp' => Auth()->user()->reg_no,
                    'created_date' => Carbon::now(),
                ]);
            }

        } else {

            $notification = array(
                'message' => 'Please add at least one course fee record',
                'alert-type' => 'error'
            );

            return redirect()->route('course.fee.show', encrypt($data['course_code']))->with($notification);
        }

        $notification = array(
            'message' => 'New Course Fee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('course.fee.show', encrypt($data['course_code']))->with($notification);
        //return redirect()->route('course.fee.index')->with($notification);
    }
}
