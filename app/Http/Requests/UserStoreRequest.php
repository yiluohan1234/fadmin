<?php

namespace App\Http\Requests;

use App\Http\Requests\CrudRequest;

class UserStoreRequest extends CrudRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:'.config('permission.table_names.users', 'users').',email',
            'name' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
