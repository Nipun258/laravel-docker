<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'study_board_id' => 'required',
            'course_cat_id' => 'required',
            'previous_course_code' => 'nullable|numeric|between:1000,100000',
            'course_name_id' => 'required',
            'course_name' => 'required',
            'medium_cat_id' => 'required',
            'course_application_open_method' => 'required',
            'payment_course_code' => 'required|numeric|between:1000,100000',
            'application_acc_number' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'study_board_id.required' => 'Select relavent study board',
            'course_cat_id.required' => 'select relavent course category',
            'medium_cat_id.required' => 'select relavent course medium',
            'course_application_open_method.required' => 'Select course application open method',
            'course_name_id.required' => 'Both course type and course name are required.',
            'course_name.required' => 'Both course type and course name are required.',
            'payment_course_code.required' => 'Payment course code is required.',
            'application_acc_number.required' => 'Application account number is required.',
            'previous_course_code.numeric' => 'Course code should be numeric',
            'payment_course_code.numeric' => 'Payment course code should be numeric',
            'application_acc_number.numeric' => 'Application account number should be numeric',
        ];
    }

    public function prepareData()
    {
        return [
            'course_main_category' => 37,
            'previous_course_code' => $this->previous_course_code,
            'course_name' => $this->course_name_id .' ' . $this->course_name,
            'medium_cat_id' => $this->medium_cat_id,
            'course_application_open_method' => $this->course_application_open_method,
            'study_board_id' => $this->study_board_id,
            'course_cat_id' => $this->course_cat_id,
            'payment_course_code' => $this->payment_course_code,
            'application_acc_number' => $this->application_acc_number,
            'active_status' => 1,
            'created_emp' => $this->user()->reg_no,
            'created_date' => Carbon::now(),
        ];
    }
}
