<?php

namespace App\Http\Requests;

use App\Http\Requests\CrudRequest;

class UserUpdateRequest extends CrudRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required',
            'name'     => 'required',
            'password' => 'confirmed',
        ];
    }
}
