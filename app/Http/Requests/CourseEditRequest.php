<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Rules\CategoryPrefix;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CourseEditRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'course_main_category' => 'required',
            'study_board_id' => 'required',
            'course_cat_id' => 'required',
            'previous_course_code' => 'nullable|numeric|between:1000,100000',
            'course_name' => ['required',new CategoryPrefix],
            'medium_cat_id' => 'required',
            'course_application_open_method' => 'required',
            'payment_course_code' => 'required|numeric|between:1000,100000',
            'application_acc_number' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'course_main_category.required' => 'Select relavent course main category',
            'study_board_id.required' => 'Select relavent study board',
            'course_cat_id.required' => 'select relavent course category',
            'medium_cat_id.required' => 'select relavent course medium',
            'course_application_open_method.required' => 'Select course application open method',
            'course_name.required' => 'VCourse name are required.',
            'payment_course_code.required' => 'Payment course code is required.',
            'application_acc_number.required' => 'Application account number is required.',
            'previous_course_code.numeric' => 'Course code should be numeric',
            'payment_course_code.numeric' => 'Payment course code should be numeric',
            'application_acc_number.numeric' => 'Application account number should be numeric',
        ];
    }

    public function persist($id)
    {

        $course = Course::findOrFail($id);
        $course->previous_course_code = $this->previous_course_code;
        $course->course_main_category = $this->course_main_category;
        $course->course_name = $this->course_name;
        $course->medium_cat_id = $this->medium_cat_id;
        $course->course_application_open_method = $this->course_application_open_method;
        $course->payment_course_code = $this->payment_course_code;
        $course->application_acc_number = $this->application_acc_number;
        $course->study_board_id = $this->study_board_id;
        $course->course_cat_id = $this->course_cat_id;
        $course->updated_emp = $this->user()->reg_no;
        $course->updated_date = Carbon::now();
        $course->save();

        return $course;
    }
}
