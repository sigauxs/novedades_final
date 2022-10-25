


    <x-app-layout>




  <div class="container mx-auto">
    {!! Form::open(['url' => '/statistics','method'=>'get','class'=>'w-4/6 mx-auto mt-10']) !!}


    <div class="flex flex-wrap mb-6 mx-auto text-center">
        <div class="w-full">


             {!! Form::label("mes", "Meses", ['class'=>'label-control mb-2']) !!}
             {!! Form::select("mes", $meses, $mes , ["style"=>"width:60%;"]) !!}
             <button class="rounded bg-indigo-600 text-white py-2 px-3" type="submit"><span class="material-icons md-18">search</span></button>
        </div>

    </div>



{!! Form::close() !!}

 <div class="w-4/6 mx-auto">
        <div class="grid grid-cols-1">
            <div class="text-center">
                {{$mes}}
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">

        <div class="text-center bg-white outline-4 outline-red-600 outline-double rounded-xl">

             <p class="text-[25px]"> Tiempo perdido mensual</p>

                <span class="text-center text-[20px]">{{$tpm}} <span>Dias </span></span> <br>
                <span  class="text-center"> {{$htpm}} Horas </span>


        </div>

        <div class="text-center bg-white outline-4 outline-red-600 outline-double rounded-xl">
            <p class="text-[25px]"> Tiempo perdido por enfermedades </p>
            <span class="text-center text-[20px]"> {{$tple}} <span>Dias </span></span><br>
            <span  class="text-center"> {{$thple}} Horas </span>
        </div>
        <div class="text-center bg-white  outline-4 outline-red-600 outline-double rounded-xl">
            <p class="text-[25px]"> Tiempo perdido por Accidentes </p>
            <span class="text-center text-[20px]"> {{$tpal}} <span>Dias </span></span><br>
            <span  class="text-center"> {{$thpal}} Horas </span>
        </div>
        <div class="text-center bg-white  outline-4 outline-red-600 outline-double rounded-xl">
            <p class="text-[25px]"> Tiempo perdido por Otras licencia </p>
            <span class="text-center text-[20px]"> {{$tpol}} <span>Dias </span></span><br>
            <span  class="text-center"> {{$thpol}} Horas </span>
        </div>
        <div class="text-center bg-white  outline-4 outline-red-600 outline-double rounded-xl">
            <p class="text-[25px]"> TPpor licencia no remunerada </p>
            <span class="text-center text-[20px]">  {{$tplnr}} <span>Dias </span></span><br>
            <span  class="text-center">  {{$thplnr}} Horas </span>
        </div>
        <div>

        </div>

        </div>
</div>

<a href="/estadisticapdf"> Descargar </a>



{!! Form::open(['url' => '/estadisticapdf', 'method' => 'get', 'class' => 'w-full max-w-lg mx-auto mt-10']) !!}
<div class="max-w-lg mx-auto text-center">
    <div style="display:none">
        {!! Form::text('mes', $mes , ['class' => 'form-control']) !!}
    </div>

    {!! Form::button("<span class='material-icons'>search</span>", [
        'type' => 'submit',
        'class' => 'rounded bg-indigo-600 text-white py-2  px-6 w-1/5',
        'formtarget' => '_blank',
    ]) !!}
</div>
{!! Form::close() !!}

</div>


    </x-app-layout>


