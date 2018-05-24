<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return fadmin_auth()->check();
    }
    /**
     * Restrict the fields that the user can change.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->only(fadmin_authentication_column(), 'name');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = fadmin_auth()->user();
        return [
            fadmin_authentication_column() => [
                'required',
                fadmin_authentication_column() == 'email' ? 'email' : '',
                Rule::unique($user->getTable())->ignore($user->getKey()),
            ],
            'name' => 'required',
        ];
    }
}
