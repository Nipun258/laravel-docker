<?php

namespace App\Http\Requests;

use App\Models\StudyBoard;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudyBoardStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studyBoardId = $this->route('id');

        return [
            'name' => ['required', 'min:3',Rule::unique(StudyBoard::class)->ignore($studyBoardId)],
            'short_name' => ['required', 'min:3',Rule::unique(StudyBoard::class)->ignore($studyBoardId)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Enter valid study board name',
            'name.min' => 'Study board name should be minimum 3 characters',
            'name.unique' => 'Study board name has already been created. Please choose another one.',
            'short_name.required' => 'Enter valid study board short name',
            'short_name.min' => 'Study board short name should be minimum 3 characters',
            'short_name.unique' => 'Study board short name has already been created. Please choose another one.',
        ];
    }

    public function prepareData()
    {
        return [
            'name' => $this->name,
            'short_name' => strtoupper($this->short_name),
            'active_status' => 1,
            'created_emp' => $this->user()->reg_no,
            'created_date' => Carbon::now(),
        ];
    }

    public function persist($id)
    {

        $studyBoard = StudyBoard::findOrFail($id);
        $studyBoard->name = $this->name;
        $studyBoard->short_name = strtoupper($this->short_name);
        $studyBoard->updated_emp = $this->user()->reg_no;
        $studyBoard->updated_date = Carbon::now();
        $studyBoard->save();

        return $studyBoard;
    }

}
