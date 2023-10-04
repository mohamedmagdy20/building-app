<?php

namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
    * @return array<string, mixed>
    *
    */
    public function rules()
    {
        return [
            'name'=>'required|string|max:100',
            'email'=> 'email|unique:users,email|max:100',
            'password'=> 'required|confirmed|string|max:50|min:5',
            'phone'=>'required|regex:/^\+965\d{6,}$/|unique:users,phone',
            'type'=>'required',
            'image'=>'file'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'=> 400,
            'message'=> 'Validation errors',
            'data'=> $validator->errors()
        ],400));
    }
}
