<div class="flex flex-wrap  mb-6 mx-auto ">
    <div class="w-full px-3">
       {!! Form::label("first_name", "Nombres", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('first_name',"",["style"=>"width:100%;",'placeholder' => 'Ingresa un nombre...']) !!}

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
       {!! Form::text('last_name',"",["style"=>"width:100%;",'placeholder' => 'Ingresa un apellido...']) !!}

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
       {!! Form::select("identification_type_id", $type_identification, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un tipo de documento...']) !!}

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
       {!! Form::text('identification',"",["style"=>"width:100%;",'placeholder' => 'Ingresa un apellido...']) !!}

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
       {!! Form::select("position_id", $positions, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un Cargo..']) !!}

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
       {!! Form::text('salary',0,["style"=>"width:100%;",'placeholder' => 'Ingresa un salario..']) !!}

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
       {!! Form::label("salary", "salario", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::text('salary',0,["style"=>"width:100%;",'placeholder' => 'Ingresa un salario..']) !!}

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
       {!! Form::label("center_cost_id", "centro de costos", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::select("center_cost_id", $centerCost, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un Cargo..']) !!}

       @error('position_id')
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
  
salary | center_cost_id | status |     created_at      |     updated_at 