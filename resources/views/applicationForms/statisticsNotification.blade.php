


    <x-app-layout>


        {{$mes}}
        {{$category}}

        <p>
            {{$tpm}}
        </p>
  <div class="container mx-auto">
    {!! Form::open(['url' => '/statistics','method'=>'get','class'=>'w-4/6 mx-auto mt-10']) !!}   
   
   
    <div class="flex flex-wrap mb-6 mx-auto">
        <div class="basis-1/3">
            

             {!! Form::label("mes", "Meses", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
             {!! Form::select("mes", $meses, $mes , ["style"=>"width:100%;"]) !!}
        </div>
        <div class="basis-1/3">
            <div class="w-full px-3">

                {!! Form::label("notificationCategory_id", "Tipos de Novedades", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
                {!! Form::select("notificationCategory_id", $notificationCategories, null , ["style"=>"width:100%;"]) !!}

            </div>
        </div>
        <div class="basis-1/3">
            <button type="submit">hola</button>
        </div>
    </div>


        
{!! Form::close() !!}
  </div>
   
    </x-app-layout>
    

