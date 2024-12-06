<?php

namespace App\Http\Requests;

use App\Models\StudyBoardSubject;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudyBoardSubjectStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studyBoardSubjectId = $this->route('id');

        return [
            'study_board_id' => ['required'],
            'name' => ['required', 'min:3',Rule::unique(StudyBoardSubject::class)->ignore($studyBoardSubjectId)],
        ];
    }

    public function messages()
    {
        return [
            'study_board_id.required' => 'Select relavent study board',
            'name.required' => 'Enter valid study board subject name',
            'name.min' => 'Study board subject should be minimum 3 characters',
            'name.unique' => 'Study board subject has already been created. Please choose another one.',
        ];
    }

    public function prepareData()
    {
        return [
            'study_board_id' => $this->study_board_id,
            'name' => ucwords($this->name),
            'active_status' => 1,
            'created_emp' => $this->user()->reg_no,
            'created_date' => Carbon::now(),
        ];
    }

    public function persist($id)
    {

        $studyBoardSubject = StudyBoardSubject::findOrFail($id);
        $studyBoardSubject->name = ucwords($this->name);
        $studyBoardSubject->study_board_id = $this->study_board_id;
        $studyBoardSubject->updated_emp = $this->user()->reg_no;
        $studyBoardSubject->updated_date = Carbon::now();
        $studyBoardSubject->save();

        return $studyBoardSubject;
    }
}
