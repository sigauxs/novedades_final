<x-app-layout>
    <div class="container mx-auto">


        <div class="w-11/12 mx-auto mt-5">
            {!! Form::open(['route' => ['employees.show', $employee->id ],'method'=>'get','class'=>'mx-auto mt-10']) !!}
     
            <div class="grid grid-cols-3 gap-x-2">

                <div>


                    {!! Form::label('b_fecha_inicio', 'De', ['class' => 'label-control-search mb-2']) !!} <span class="text-red-600 font-bold text-base"
                        title="Campo obligatorio">*</span>
                    {!! Form::date('b_fecha_inicio', $b_fecha_inicio, ['class' => 'form-control-search']) !!}



                </div>
                <div>
                    {!! Form::label('b_fecha_final', 'Hasta', ['class' => 'label-control-search inline mb-2']) !!} <span class="text-red-600 font-bold text-base"
                        title="Campo obligatorio">*</span>
                    {!! Form::date('b_fecha_final', $b_fecha_final, ['class' => 'form-control-search']) !!}
                </div>

                <div>
                    <button id="buscar" type="submit" class="bg-green-500 btn-search mt-7 "> <span
                            class='material-icons' style='color:white; font-size:26px'> search </span> </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="w-11/12 mx-auto mt-5">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ $employee->first_name }}{{ $employee->last_name }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $employee->position->name }}</p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">C.C. {{ $employee->identification }}</p>
                </div>

            </div>
        </div>

        <div class="w-11/12 mx-auto">
            @if (session('success'))
            <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
              <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
              <div>
                <span class="font-medium">{{ session('success') }}</span>
              </div>
            </div>

          @endif
            <table class="min-w-full text-center">
                <thead class="border-b bg-gray-800">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                            #
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                           Novedad                       </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                            Fecha de inicio                        </th>
                        <th scope="col" class="  text-sm font-medium text-white px-4 py-2">
                            Fecha de final
                        </th>
                        <th scope="col" class=" text-sm font-medium text-white px-4 py-2">
                            Dias
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                            Horas
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                            Observaciones
                        </th>
                        <th scope="col" colspan="3" class="text-sm font-medium text-white px-4 py-2">
                            Soporte
                        </th>
                    </tr>
                </thead class="border-b">




                <tbody>
                    @foreach ($notifications as $notification)
                        <tr class="bg-white border-b ">

                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->index + 1 }}</td>

                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                    {{ $notification->notificationType->name}}
                            </td>

                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($notification->started_date )->translatedFormat('j F, Y')}} {{ \Carbon\Carbon::parse($notification->started_time )->translatedFormat('h:i:s A')}}
                            </td>


                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($notification->finish_date )->translatedFormat('j F, Y')}} {{ \Carbon\Carbon::parse($notification->finish_time )->translatedFormat('h:i:s A')}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ $notification->total_days }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ $notification->total_hours }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ $notification->observation }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{ $notification->support ? 'Entregado' : 'No entregado' }}
                            </td>









                        </tr class="bg-white border-b">
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
    </div>

    <div>






<div class="container mx-auto">
    <div class="grid grid-cols-2 gap-2 mb-10">
        <div>
            {!! Form::open(['url' => '/employeepdf', 'method' => 'get', 'class' => 'w-full max-w-lg mx-auto mt-10']) !!}
            <div class="max-w-lg mx-auto text-center">
                <div style="display:none">
                 
                </div>

                {!! Form::button("<span class='material-icons' style='color:white; font-size:20px'> picture_as_pdf</span>", [
                    'type' => 'submit',
                    'class' => 'rounded bg-red-600 text-white btn-base',
                    'formtarget' => '_blank',
                ]) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div>
            {!! Form::open(['url' => '/allemployeepdf', 'method' => 'get', 'class' => 'w-full max-w-lg mx-auto mt-10']) !!}
            <div class="max-w-lg mx-auto text-center">
                <div style="display:none">
                   
                </div>

                {!! Form::button("<span class='material-icons' style='color:white; font-size:20px'> picture_as_pdf</span>", [
                    'type' => 'submit',
                    'class' => 'rounded bg-indigo-600 text-white btn-base',
                    'formtarget' => '_blank',
                ]) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


    </div>
</x-app-layout>
