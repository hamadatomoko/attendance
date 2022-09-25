<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Schedule;

class ScheduleCreateRequest extends FormRequest
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
        $rules = array_merge(Schedule::$rules, ['end_date' => 'date_equals:start_date']);
        return $rules;
    }
    
    protected function validationData()
    {
        $data = $this->all();
        $data['start_date'] = date('Y-m-d', strtotime($this->start_time));
        $data['end_date'] = date('Y-m-d', strtotime($this->end_time));
        
        return $data;
    }
}
