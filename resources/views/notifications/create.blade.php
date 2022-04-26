
<x-app-layout>

    <div class="container mx-auto">

{{$user}}
      
      {!! Form::open(['route'=>'notifications.store','class'=>'w-full max-w-lg mx-auto mt-10']) !!}

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("started_date", "Fecha de inicio", ['class'=> 'label-control inline-block mb-2']) !!}<span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
            
             {!! Form::datetimeLocal("started_date", null ,['class'=>'form-control']) !!}

             @error('started_date')
             <small class="text-red-600 font-bold text-base">
              *{{$message}}
             </small>
             <br>
             @enderror
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
           {!! Form::label("finish_date", "Fecha de finalización", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
          
           {!! Form::datetimeLocal("finish_date", null ,['class'=>'form-control']) !!}

           @error('finish_date')
           <small class="text-red-600 font-bold text-base">
              *{{$message}}
             </small>
             <br>
             @enderror
        </div>
      </div>


      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("type_identification_id", "Tipo de identificación", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
             {!! Form::select("type_identification_id", $types, null , ["class"=>"form-control",'placeholder' => 'Selecciona una tipo de identificación...']) !!}

             @error('type_identification_id')
             <small class="text-red-600 font-bold text-base">
              *{{$message}}
             </small>
             <br>
             @enderror
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto ">
        <div class="w-full px-3">
           {!! Form::label("employee_id", "Empleados", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("employee_id", $employees, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un empleado...']) !!}

           @error('employee_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
           {!! Form::label("center_cost_id", "Centro de costos", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("center_cost_id", $center_costs, null , ["class"=>"form-control",'placeholder' => 'Selecciona un empleado...']) !!}

           @error('center_cost_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
           {!! Form::label("position_id", "Cargo", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("position_id", $positions, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona el cargo correspondiente..']) !!}

           @error('position_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
           {!! Form::label("boss_id", "Jefes", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("boss_id", $bosses, null , ["class"=>"form-control",'placeholder' => 'Selecciona Jefe de area']) !!}

           @error('boss_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      
      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
           {!! Form::label("notifications_type_id", "Tipos de novedades", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("notifications_type_id", $notifications, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona el tipo de novedad']) !!}

           @error('notifications_type_id')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
            {!! Form::label("observation", "observation", ['class'=>'label-control inline-block mb-2']) !!}
            {!! Form::textarea("observation", null , ["class"=>"form-control"]) !!}
                  
           @error('observation')
           <small class="text-red-600 font-bold text-base">
            *{{$message}}
           </small>
           <br>
           @enderror
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3 ">
        {!! Form::submit("Registrar", ["class"=>"rounded bg-indigo-600 text-white py-2  px-8"]) !!}
       </div>
      </div>

        {!!Form::close() !!}
    </div>



    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          $('#cost_center_id').select2({ });
          $('#cost_sub_center_id').select2({ });
          $('#expense_id').select2({ });
          $('#employee_id').select2({});
          $('#position_id').select2({});
          $('#notifications_type_id').select2({});
      });
    </script>
  @endpush
  </x-app-layout>






