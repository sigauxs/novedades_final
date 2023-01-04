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
            'identification'=> 'required|numeric',
            'status'=>'required'
        ];
    }



    public function messages(){
            return [
                 'first_name.required' => 'El nombre es obligatorio',
                 'last_name.required' => 'El apellido es obligatorio',
                 'identification_type_id.required' => 'El tipo de documento es obligatorio',
                 'identification.required' => 'El numero de identificación debe ser obligatorio',
                 'identification.numeric' => 'El numero de identificación deben ser numeros',
                 'status.required' => 'El estado es obligatorio'

            ];
    }




}
