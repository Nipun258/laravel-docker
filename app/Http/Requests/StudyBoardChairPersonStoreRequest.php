<?php

namespace App\Http\Requests;

use App\Models\ChairPerson;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StudyBoardChairPersonStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'study_board_id' => 'required',
            'emp_no' => 'required',
            'appointment_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'study_board_id.required' => 'Select relavent study board',
            'emp_no.required' => 'Select relavent study board chair person',
            'appointment_type_id.required' => 'Select relavent appointment type',
            'start_date.required' => 'Select relavent appointment date',
            'end_date.after_or_equal' => 'The termination date must be after or equal to the appointment date.',
        ];
    }

    public function prepareData()
    {
        return [
            'study_board_id' => $this->study_board_id,
            'emp_no' => $this->emp_no,
            'appointment_type_id' => $this->appointment_type_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'active_status' => 1,
            'created_emp' => $this->user()->reg_no,
            'created_date' => Carbon::now(),
        ];
    }

    public function persist($id)
    {

        $studyBoardChairPerson = ChairPerson::findOrFail($id);

        if ($studyBoardChairPerson->emp_no != $this->emp_no) {
            // Set the existing record's active_status to 0
            $studyBoardChairPerson->active_status = 0;
            $studyBoardChairPerson->updated_emp = $this->user()->reg_no;
            $studyBoardChairPerson->updated_date = Carbon::now();
            $studyBoardChairPerson->save();

            // Create a new record
            $newChairPerson = new ChairPerson();
            $newChairPerson->study_board_id = $this->study_board_id;
            $newChairPerson->emp_no = $this->emp_no;
            $newChairPerson->appointment_type_id = $this->appointment_type_id;
            $newChairPerson->start_date = $this->start_date;
            $newChairPerson->end_date = $this->end_date;
            $newChairPerson->active_status = 1;
            $newChairPerson->created_emp = $this->user()->reg_no;
            $newChairPerson->created_date = Carbon::now();
            $newChairPerson->save();

            return $newChairPerson;

        } else {
            // Update the existing record
            $studyBoardChairPerson->appointment_type_id = $this->appointment_type_id;
            $studyBoardChairPerson->start_date = $this->start_date;
            $studyBoardChairPerson->end_date = $this->end_date;
            $studyBoardChairPerson->updated_emp = $this->user()->reg_no;
            $studyBoardChairPerson->updated_date = Carbon::now();
            $studyBoardChairPerson->save();

            return $studyBoardChairPerson;
        }
    }
}
