


    <x-app-layout>




  <div class="container mx-auto">
    {!! Form::open(['url' => '/statistics','method'=>'get','class'=>'w-4/6 mx-auto mt-10']) !!}


    <div class="flex flex-wrap mb-6 mx-auto">
        <div class="basis-1/3">


             {!! Form::label("mes", "Meses", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
             {!! Form::select("mes", $meses, $mes , ["style"=>"width:100%;"]) !!}
        </div>

        <div class="basis-1/3">
            <button type="submit">hola</button>
        </div>
    </div>



{!! Form::close() !!}

<div class="w-4/6 mx-auto">
    <div class="grid grid-cols-2 gap-4">

        <div>

        <p class="text-center"> Tiempo perdido mensual</p>

        <span class="text-center">{{$tpm}} </span> <br>
        <span>Dias Aproximados</span>
        <br>
        <span> {{$tpm}} Horas </span>


        </div>

        <div>{{$tple}}</div>
        <div>
            {{$tpal}}
        </div>
        <div>
            {{$tpol}}
        </div>
        <div>
            {{$tplnr}}
        </div>

      </div>
      </div>
</div>


    </x-app-layout>


