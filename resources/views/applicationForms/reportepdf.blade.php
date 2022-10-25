<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>


.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

body{
    font-size: 15px;
}
    </style>

</head>
<body>


  <h1> Este un reporte de estadisticas</h1>
  <div class="w-4/6 mx-auto">
    <div class="grid grid-cols-1">
        <div class="text-center">

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


    <div>
   
    </div>


</body>
</html>
