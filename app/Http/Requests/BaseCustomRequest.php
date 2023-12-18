<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;

class BaseCustomRequest extends FormRequest{

    protected function failedValidation(ValidationValidator $validator)
    {
        
        if ($this->expectsJson()) {
        
            
            return response()->json([
                'message' => "Validation Errors",
                'status' => false,
                'errors' => $validator->errors()->getMessages(),
            ]);
             
            parent::failedValidation($validator); 
        }
    }
}
