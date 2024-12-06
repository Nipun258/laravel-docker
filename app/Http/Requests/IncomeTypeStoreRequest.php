<?php

namespace App\Http\Requests;

use App\Models\IncomeType;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncomeTypeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $incomeTypeId = $this->route('id');

        return [
            'pay_income_type_code' => ['required','numeric', Rule::unique(IncomeType::class)->ignore($incomeTypeId)],
            'income_type_name' => ['required', 'min:3',Rule::unique(IncomeType::class)->ignore($incomeTypeId)],
        ];
    }

    public function messages()
    {
        return [
            'pay_income_type_code.required' => 'Enter payment income type code',
            'pay_income_type_code.numeric' => 'Enter payment income type code should be numeric',
            'pay_income_type_code.unique' => 'Payment income type code has already been created. Please choose another one.',
            'income_type_name.required' => 'Enter valid income type name',
            'income_type_name.min' => 'Income type name should be minimum 3 characters',
            'income_type_name.unique' => 'Income type name has already been created. Please choose another one.',
        ];
    }

    public function prepareData()
    {
        return [
            'pay_income_type_code' => $this->pay_income_type_code,
            'income_type_name' => $this->income_type_name
        ];
    }

    public function persist($id)
    {

        $incomeType = IncomeType::findOrFail($id);
        $incomeType->pay_income_type_code = $this->pay_income_type_code;
        $incomeType->income_type_name = $this->income_type_name;
        $incomeType->save();

        return $incomeType;
    }
}
