<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id'    => ['required', 'exists:countries,id'],
            'status_id'     => ['required', 'exists:company_statuses,id'],
            'name'          => ['required', 'string', 'max:255'],
            'reg'           => ['required', 'string', 'max:255', 'unique:organizations,reg,' . $this->id],
            'vat'           => ['nullable', 'max:255', 'unique:organizations,vat,' . $this->id],
            'legal_address' => ['required', 'string', 'max:255'],
            'address'       => ['required', 'string', 'max:255'],
            'source'        => ['required', 'string', 'max:255']
        ];
    }
}