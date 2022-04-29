<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'started_date' => 'required',
            'finish_date' => 'required',
            'employee_id' => 'required',
            'boss_id' => 'required',
            'center_cost_id' => 'required',
            'type_identification_id' => 'required',
            'notifications_type_id' => 'required'
        ];
    }

    public function attributes()
        {
            return [
              'started_date' => 'Fecha de inicio',
              'finish_date' =>  'Fecha de finalizacion',
              'employee_id' => 'Empleado',
              'boss_id' => 'Jefe inmediato',
              'center_cost_id' => 'Centro de costo',
              'type_identification_id' => 'Tipo de identificación',
              'notifications_type_id' => 'Tipo de novedades'
             ];
        }
}
