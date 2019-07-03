<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'color'  => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string', 'max:255']
        ];
    }
}