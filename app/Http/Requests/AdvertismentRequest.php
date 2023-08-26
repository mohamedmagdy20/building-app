<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdvertismentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|string',
            'category_id'=>'required',
            'area_id'=>'required',
            'price'=>'required',
            'advantages'=>'nullable',
            'links'=>'required|url',
            'description'=>'required|string',
            'space'=>'required',
            'location'=>'nullable',
            'number'=>'required',
            'num_of_rooms'=>'nullable',
            'num_of_lounges'=>'nullable',
            'num_of_bath'=>'nullable',
            'num_of_apartments'=>'nullable',
            'num_of_floor'=>'nullable',
            'type'=>'required|string',
            'ads_type'=>'required',
            'access_token'=>'required',
            'image_1'=>'nullable|file',
            'image_2'=>'nullable|file',
            'image_3'=>'nullable|file',
            'image_4'=>'nullable|file',
            'image_5'=>'nullable|file',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'=> 403,
            'message'=> 'Validation errors',
            'data'=> $validator->errors()
        ],403));
    }

}
