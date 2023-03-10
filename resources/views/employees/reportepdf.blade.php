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

    <div class="mx-auto">
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{$employee->first_name }}{{$employee->last_name }}</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">{{$employee->position->name }}</p>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">C.C. {{$employee->identification }}</p>
              <p>licencias por EPS
                @if ( isset($eps))
                {{ $eps }}

              @endif
            </p>
              <p>Licencias por Arl @if ( isset($arl))
                {{ $arl }}

              @endif</p>
              <p>Vacaciones @if ( isset($vacaciones))
                {{ $vacaciones }}

              @endif dias</p>
              <p>Retrasos @if ( isset($retrasos))
                {{ $retrasos }}

              @endif</p>
    </div>

    <div>
        <table class="min-w-full text-center">
            <thead class="border-b bg-gray-800">
              <tr>
                <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                  #
                </th>
                <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                  Novedad
                </th>
                <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                   Fecha de inicio
                </th>
                <th scope="col"
                class="  text-sm font-medium text-white px-4 py-2">
                    Fecha final
                </th>
                <th scope="col"
                class=" text-sm font-medium text-white px-4 py-2">
                    Total de dias
                </th>
                <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                 Total de horas
                </th>
                <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                    Observacion
                </th>


                <th scope="col" colspan="3" class="text-sm font-medium text-white px-4 py-2">
                      Soporte
                </th>
              </tr>
            </thead class="border-b">




            <tbody style="text-align: center">
             @foreach ($notifications as $notification)
                <tr class="bg-white border-b ">

                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1  }}</td>

                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900"> {{$notification->notificationType->name}}</td>

                   <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                     {{ \Carbon\Carbon::parse($notification->started_date)->translatedFormat('j F, Y')}}
                    </td>


                  <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($notification->finish_date)->translatedFormat('j F, Y')}}
                  </td>
                    <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                   {{ $notification->total_days }}
                    </td>
                  <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                  {{ $notification->total_hours}}
                  </td>
                <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                       {{ $notification->observation  }}
                </td>
                <td style ="text-center" class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                    {{ $notification->support ? "Entregado":" No entregado" }}
                </td>









                  </tr >
                @endforeach
                <tr class="bg-white border-b ">
                    <td colspan="4">total</td>
                    <td>{{ $sumaDias }}</td>
                    <td>{{ $sumaHoras }}</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>




        </table>
    </div>


</body>
</html>
