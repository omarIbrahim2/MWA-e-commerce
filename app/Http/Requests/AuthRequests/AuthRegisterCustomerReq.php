<?php

namespace App\Http\Requests\AuthRequests;

use App\Http\Requests\BaseCustomRequest;

class AuthRegisterCustomerReq extends BaseCustomRequest
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
            "user_id"=> "numaric|exists:users,id",
        ];
    }
}
