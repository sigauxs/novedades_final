<x-app-layout>
    <div class="container mx-auto">


        <div class="w-11/12 mx-auto mt-5">
            {!! Form::open(['route' => ['employees.show', $employee->id],'method'=>'get','class'=>'mx-auto mt-10']) !!}
            <div class="grid grid-cols-2 mb-6 mx-auto ">
                <div>
                    {!! Form::label("mes", "Mes", ['class'=>'label-control inline-block mb-2']) !!}  <span class="text-red-600 font-bold text-base" title="Campo obligatorio">*</span>
                    {!! Form::select("mes", $month, $mes, ["style"=>"width:100%;",'placeholder' => 'Selecciona un empleado...']) !!}
                </div>
                <div>
<button type="submit"> consultar </button>
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



        {!! Form::open(['url' => '/employeepdf', 'method' => 'get', 'class' => 'w-full max-w-lg mx-auto mt-10']) !!}
        <div class="max-w-lg mx-auto text-center">
            <div style="display:none">
                {!! Form::text('id', $employee->id, ['class' => 'form-control']) !!}
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
