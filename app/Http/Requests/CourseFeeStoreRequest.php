<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFeeStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'reg_year' => 'required|array',
            'reg_year.*' => 'required|integer',
            'batch' => 'required|array',
            'batch.*' => 'required|integer',
            'intake' => 'required|array',
            'intake.*' => 'required|integer',
            'pay_income_type_id' => 'required|array',
            'pay_income_type_id.*' => 'required|integer',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|min:0',
        ];
    }
}
