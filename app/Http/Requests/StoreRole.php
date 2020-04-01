<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_role_name' => 'required|string|not_in:admin,Super Admin,super admin,Admin',
            'permissions_to_roles' => 'array',
            'permissions_to_roles.*' => 'string'
        ];
    }
}
