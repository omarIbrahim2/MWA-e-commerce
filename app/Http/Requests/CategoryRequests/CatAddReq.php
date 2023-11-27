<?php

namespace App\Http\Requests\CategoryRequests;

use App\Http\Requests\BaseCustomRequest;
<<<<<<< HEAD:app/Http/Requests/CatAddReq.php
=======
use Illuminate\Foundation\Http\FormRequest;
>>>>>>> 04be39cd423c659d9aa798d27e7146a4d149ef87:app/Http/Requests/CategoryRequests/CatAddReq.php

class CatAddReq extends BaseCustomRequest
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
            "catName"=> "string|required|max:50",
            "img" =>"image|mimes:jpg,png,jpeg,webp"
        ];
    }
}
