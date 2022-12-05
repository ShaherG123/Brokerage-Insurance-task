<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Foundation\Http\FormRequest; 
use Illuminate\Http\JsonResponse; 
use Illuminate\Validation\ValidationException; 

class MainRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        $response = new JsonResponse( $array = [ 
                'data' => [], 
                'message' => 'The given data was invalid.', 
                'status' => false, 
                'errors' => $validator->errors(), 
                'count' => 0, 
            ], 
            422 ); 
        throw new ValidationException($validator, $response); 
    }
}
