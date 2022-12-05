<?php

namespace App\Http\Requests;

class CustomerRequest extends MainRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'employee_id' => 'exists:users,id|sometimes',
            'action_id' => 'exists:actions,id|sometimes'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
        ];
    }
}
