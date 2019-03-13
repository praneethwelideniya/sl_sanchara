<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ];
    }

    public function messages(){
        return [
            'pic.required' => 'Picture is reuired',
            'pic.image' => 'File must be a Image',
            'pic.image' =>'This type is not support',
            'pic.max' =>'Maximum file size is 5MB'
        ];
    }
}
