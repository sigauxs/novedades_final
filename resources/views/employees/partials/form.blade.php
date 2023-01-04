

    <div class="flex flex-wrap  mb-6 mx-auto ">
        <div class="w-full px-3">
           {!! Form::label("center_cost_id", "centro de costos", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("center_cost_id", $centerCost,isset($employee->center_cost_id) ? $employee->center_cost_id : '' , ['class'=>'form-control', "style"=>"width:100%;",'placeholder' => 'Selecciona un Centro de costo o area..']) !!}

           @error('position_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>





<div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("first_name", "Nombres", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('first_name',isset($employee->first_name) ? $employee->first_name : '',['class'=>'form-control',"style"=>"width:100%;",'placeholder' => 'Ingresa un nombre...']) !!}

       @error('first_name')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
       @enderror

    </div>
</div>

  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("last_name", "Apellidos", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('last_name',isset($employee->last_name) ? $employee->last_name : '',['class'=>'form-control', "style"=>"width:100%;",'placeholder' => 'Ingresa un apellido...']) !!}

       @error('last_name')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
       @enderror

    </div>
  </div>

  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("type_identification_id", "Tipos de documentos", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::select("identification_type_id", $type_identification, isset($employee->identification_type_id) ? $employee->identification_type_id : '' , ['class'=>'form-control', "style"=>"width:100%;",'placeholder' => 'Selecciona un tipo de documento...']) !!}

       @error('identification_type_id')
       <small class="text-red-600 font-bold text-base">
        *{{$message}}
       </small>
       <br>
       @enderror
    </div>
  </div>


  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("identification", "Numero de identificación", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('identification',isset($employee->identification) ? $employee->identification : '',['class'=>'form-control', "style"=>"width:100%;",'placeholder' => 'Ingresa un numero de identificaciòn..']) !!}

       @error('identification')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
       @enderror

    </div>
  </div>


  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("position_id", "Cargos", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::select("position_id", $positions,isset($employee->position_id) ? $employee->position_id : '' , ["style"=>"width:100%;",'placeholder' => 'Selecciona un Cargo..']) !!}

       @error('position_id')
       <small class="text-red-600 font-bold text-base">
        *{{$message}}
       </small>
       <br>
       @enderror
    </div>
  </div>


  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("salary", "salario", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('salary',isset($employee->salary) ? $employee->salary : 0 ,['class'=>'form-control', "style"=>"width:100%;",'placeholder' => 'Ingresa un salario..']) !!}

       @error('salary')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
       @enderror

    </div>
  </div>



  <div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("status", "Estado", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::select("status", $status, isset($employee->status) ? $employee->status : 1 , ['class'=>'form-control',"style"=>"width:100%;",'placeholder' => 'Selecciona un estado...']) !!}

       @error('status')
       <small class="text-red-600 font-bold text-base">
        *{{$message}}
       </small>
       <br>
       @enderror
    </div>
  </div>



  <div class="flex flex-wrap  mb-6 mx-auto">


    <div class="grid grid-cols-2 max-w-lg mx-auto text-center">
     <div class="">
         {!! Form::submit("Registrar", ["class"=>"rounded bg-indigo-600 text-white py-2  px-8"]) !!}
      </div>
     <div class="">
         <a href="/notifications"> <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> Regresar </button></a>
     </div>


    </div>
  </div>

  @push('scripts')
 <script type="text/javascript">
      $(document).ready(function() {

        $('#position_id').select2({});

    });
  </script>
@endpush

