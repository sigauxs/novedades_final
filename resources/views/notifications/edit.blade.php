<x-app-layout>

        {!! Form::model($notification, ['route' => ['notifications.update', $notification->id],'method'=>'put','class'=>'w-full max-w-lg mx-auto mt-10']) !!}

       
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


      
    
          <div class="grid grid-cols-2 mb-6 mx-auto">
              <div class="px-3">
                {!! Form::label("started_date", "Fecha de inicio", ['class'=> 'label-control inline-block mb-2']) !!}<span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
                {!! Form::date("started_date",  (isset($notification)) ? $notification->started_date : null ,['class'=>'form-control']) !!}
      
              @error('started_date')
              <small class="text-red-600 font-bold text-base">
                *{{$message}}
                </small>
               <br>
              @enderror
            </div>
      
            <div class="px-3">
               {!! Form::label("started_time", "Hora de inicio", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
               {!! Form::time("started_time", (isset($notification)) ? $notification->started_time : null  ,['class'=>'form-control']) !!}
            </div>


        </div>

        <div class="grid grid-cols-2 mb-6 mx-auto">
          <div class="px-3">
            {!! Form::label("finish_date", "Fecha de finalización", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
            {!! Form::date("finish_date", (isset($notification)) ? $notification->finish_date : null ,['class'=>'form-control']) !!}
          @error('finish_date')
          <small class="text-red-600 font-bold text-base">
             *{{$message}}
            </small>
            <br>
            @enderror
         </div>

         <div class="px-3">
           {!! Form::label("finish_time", "Hora de final", ['class'=>'label-control inline-block mb-2']) !!} <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
           {!! Form::time("finish_time", (isset($notification)) ? $notification->finish_time : null,['class'=>'form-control']) !!}
          </div>

          
        </div>


        <div class="flex flex-wrap  mb-6 mx-auto" style="display: none">
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


    

        <div class="flex flex-wrap  mb-6 mx-auto">
            <div class="w-full px-3">
                {!! Form::label("support", "Soporte Entregado", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
                <div class="text-center">
                    {!! Form::checkbox('support',null ,$notification->support,['class'=>'form-check-input inline-block appearance-none w-24 rounded-full  h-8 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm'] ) !!}
                </div>

        </div>
</div>
        <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("observation", "observación", ['class'=>'label-control inline-block mb-2']) !!}
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
                {!! Form::submit("Actualizar", ["class"=>"rounded bg-indigo-600 text-white py-2  px-8"]) !!}
             </div>
            <div class="">
                <a href="{{url()->previous()}}"> <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> Regresar </button></a>
            </div>


           </div>
        </div>







        {!!Form::close() !!}


    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          $('#cost_center_id').select2({ });
          $('#expense_id').select2({ });
          $('#employee_id').select2({});
          $('#position_id').select2({});
          $('#notifications_type_id').select2({});
      });
    </script>
  @endpush
</x-app-layout>


          <!-- Toggle B
          {{--<div class="flex items-center justify-center w-full mb-12">

            <label for="toggleB" class="flex items-center cursor-pointer">
              <!-- toggle -->
              <div class="relative">
                <!-- input -->
                <!--<input type="checkbox" name="support" class="sr-only" id="toggleB" value="1" />-->


                <!-- line -->
                <div class="block bg-gray-400 w-14 h-8 rounded-full"></div>
                <!-- dot -->
                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
              </div>
              <!-- label -->
              <div class="ml-3 text-gray-700 font-medium">
                Soporte Entregado
              </div>
            </label>

          </div>-->--}}
