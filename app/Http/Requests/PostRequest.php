<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

            'Studentid' => 'required',
            'email' => 'required|email',
            'name' => 'required|min:4',
            'number' => 'required',
            'Address' => 'required',
            'courseid' => 'required',
            'Birth' => 'required',
            'Grades' => 'required',
            'Mentor' => 'required'
        ];
    }

//     public function messages()
// {
//     return [
//         'Studentid.required' => 'id is required',
//         'email.required' => 'email is required',
//         'number.required' => 'number is required',
//         'Address.required' => 'Address is required',
//         'courseid.required' => 'course is required',
//         'Birth.required' => 'birth date is required',
//         'Grades.required' => 'grade is required',
//         'Mentor.required' => 'mentor is required',
//     ];
// }
}
