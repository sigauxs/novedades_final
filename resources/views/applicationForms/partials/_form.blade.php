
   <div class="flex flex-wrap  mb-6 mx-auto" style="display: none">
    <div class="w-full px-3">
       {!! Form::label("type_identification_id", "Tipo de identificación", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
       {!! Form::select("type_identification_id", $types, null , ["class"=>"form-control",'']) !!}

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
           {!! Form::select("employee_id", $employee, null , ["style"=>"width:100%;"]) !!}

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

           {!! Form::label("notifications_type_id", "Tipos de novedades", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("notifications_type_id", $type_notifications , null , ["style"=>"width:100%;",'placeholder' => 'Selecciona el tipo de novedad']) !!}

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
           {!! Form::label("center_cost_id", "Centro de costos", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("center_cost_id", $center_costs, null , ["class"=>"form-control"]) !!}

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
           {!! Form::label("boss_id", "Jefes", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::select("boss_id", $bosses, null , ["class"=>"form-control","readonly"]) !!}

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
             {!! Form::label("support", "Soporte Entregado", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
         <div class="text-center">
                 {!! Form::checkbox('support',null ,null,['class'=>'form-check-input inline-block appearance-none w-24 rounded-full  h-8 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm'] ) !!}
         </div>
       </div>

     
      {{-- <div class="flex flex-wrap  mb-6 mx-auto">
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
      </div>--}}



   

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
            {!! Form::label("observation", "Observación", ['class'=>'label-control inline-block mb-2']) !!}
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


       <div class="grid grid-cols-2 max-w-lg mx-auto text-center">
        <div class="">
            {!! Form::submit("Registrar", ["class"=>"rounded bg-indigo-600 text-white py-2  px-8"]) !!}
        </div>
        <div class="">
            <a href="/notifications"> <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> Regresar </button></a>
        </div>
       </div>
      </div>

       
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