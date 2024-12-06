<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('id');

        return [
            'name' => ['required', 'min:3',Rule::unique(Role::class)->ignore($roleId)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Enter valid role name',
            'name.min' => 'Role name should be minimum 3 characters',
            'name.unique' => 'Role name has already been craeted. Please choose another one.',
        ];
    }

    public function prepareData()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function persist($id)
    {

        $role = Role::findOrFail($id);
        $role->name = $this->name;
        $role->save();

        return $role;
    }
}
