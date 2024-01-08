<?php

namespace App\Http\Requests\AuthRequests;

use App\Http\Requests\BaseCustomRequest;

class AuthRegisterMerchantReq extends BaseCustomRequest
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
            "user_id"=> "exists:users,id",
            'img' => 'image|mimes:jpg,png,jpeg,webp|max:2048|',
            "role_id" =>"required",
            "name" => "required|string|min:3|max:50",
            "email"=> "required|email",
            "password"=> "required|confirmed|min:6",
            "phone"=> "min:11",
            "address"=> "string",
        ];
    }
}
