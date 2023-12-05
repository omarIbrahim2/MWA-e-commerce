<?php

namespace App\Http\Requests\AuthRequests;

use App\Http\Requests\BaseCustomRequest;

class AuthRegisterReq extends BaseCustomRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "role_id" =>"required|numaric",
            "name" => "required|string|min:3|max:50",
            "email"=> "required|email",
            "password"=> "required|confirmed|min:6",
            "phone"=> "numaric|min:11",
            "address"=> "string",
        ];
    }
}
