<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingsRequest extends FormRequest
{
    /**
     * Check Authorize
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation Rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zero_sales_act_companies' => ['required', 'integer'],
        ];
    }
}
