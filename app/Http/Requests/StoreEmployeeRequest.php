<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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

  
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type_id' => 'required',
            'identification'=> 'required|numeric'
        ];
    }



    public function messages(){
            return [
                 'first_name.required' => 'El nombre es requerido',
                 'last_name.required' => 'El apellido es requerido',
                 'identification_type_id.required' => 'El tipo de documento es requerido',
                 'identification.required' => 'El numero de identificación debe ser requerido',
                 'identification.numeric' => 'El numero de identificación deben ser numeros'

            ];
    }




}
