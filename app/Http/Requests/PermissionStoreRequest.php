<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $permissionId = $this->route('id');

        return [
            'permission_group' => ['required'],
            'name' => ['required', 'min:3', Rule::unique(Permission::class)->ignore($permissionId)],
        ];
    }

    public function messages()
    {
        return [
            'permission_group.required' => 'Select relavent permission group',
            'name.required' => 'Enter valid permission name',
            'name.min' => 'Permission name should be minimum 3 characters',
            'name.unique' => 'Permission name has already been created. Please choose another one.',
        ];
    }

    public function prepareData()
    {
        return [
            'name' => $this->name,
            'permission_group_category_id' => $this->permission_group,
        ];
    }

    public function persist($id)
    {

        $permission = Permission::findOrFail($id);
        $permission->name = $this->name;
        $permission->save();

        return $permission;
    }
}
