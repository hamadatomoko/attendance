<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Attendance;

class AttendanceCreateRequest extends FormRequest
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
        return Attendance::$rules;
        //
    }
    protected function validationData()
    {
        $data = $this->all();
        $data['start_time'] = date('Y-m-d', strtotime($this->start_time));
        $data['end_time'] = date('Y-m-d', strtotime($this->end_time));

        return $data;
    }
}
