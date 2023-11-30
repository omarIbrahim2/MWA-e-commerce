<?php

namespace App\Http\Requests\ItemRequests;

use App\Http\Requests\BaseCustomRequest;

class ItemAddReq extends BaseCustomRequest
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
            "cat_id"=> "required|numeric|exists:cats,id",
            "itemName"=> "string|required|max:50",
            "img" =>"image|mimes:jpg,png,jpeg,webp"
        ];
    }
}
