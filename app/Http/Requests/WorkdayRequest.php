<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkdayRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'start_date'          => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date'          => ['required', 'date_format:Y-m-d H:i:s'],
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'work_schedule_id' => ['required', 'exists:work_schedules,id'],
                'workforce_id' => ['required', 'exists:workforces,id']
            ];
        }

        return $rules;
    }
}
