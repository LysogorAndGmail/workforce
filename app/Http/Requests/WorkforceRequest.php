<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkforceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'job_title_id' => ['required', 'exists:job_titles,id'],
            'fname'        => ['required', 'string', 'max:255'],
            'lname'        => ['required', 'string', 'max:255'],
            'gender'       => ['required', 'boolean'],
            'dob'          => ['required', 'date'],
            'is_personnel' => ['required', 'boolean'],
            'phone'        => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255'],
        ];
    }
}



