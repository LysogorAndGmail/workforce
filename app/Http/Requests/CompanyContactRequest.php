<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'fname' => ['required', 'string', 'max:255'],
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['company_id' => ['required', 'exists:companies,id']];
        }

        return $rules;
    }
}