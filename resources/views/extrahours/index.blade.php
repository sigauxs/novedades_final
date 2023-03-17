<x-app-layout>



    {{ (int) date('M') + 1 }}




    <div class="container mx-auto">


        <div class="w-11/12 mx-auto mt-5">

            <div class=" mb-6 mx-auto w-4/5">
                {!! Form::open(['route' => ['extrahours.index'], 'method' => 'get', 'id' => 'formSearch']) !!}

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

        </div>





        <div class="flex flex-col">

            @if (session('success'))
                <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-4 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-gray-800">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                                        Empleados
                                    </th>
                                    <th scope="col"
                                        class="{{ $user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do and $user_model->profile_id == 2) ? '' : 'none' }}  text-sm font-medium text-white px-4 py-2">
                                        Centro de costos
                                    </th>
                                    <!-- <th scope="col"
                                        class="{{ $user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do and $user_model->profile_id == 2) ? '' : 'none' }}  text-sm font-medium text-white px-4 py-2">
                                        Jefe de inmediato
                                    </th>-->
                                    <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                                        Novedad
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                                        Fecha de inicio
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                                        Fecha de finalizacion
                                    </th>
                                    <th scope="col" colspan="3" class="text-sm font-medium text-white px-4 py-2">

                                    </th>
                                </tr>
                            </thead class="border-b">




                            <tbody>
                                @foreach ($extrahours as $notification)
                                    <tr class="bg-white border-b {{ $notification->support ? '' : 'bg-red-200' }}">

                                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $notification->id }}</td>

                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ $notification->nombres }} {{ $notification->apellidos }}
                                        </td>


                                        <td
                                            class="
                           {{ $user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do and $user_model->profile_id == 2) ? '' : 'none' }}
                           text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ $notification->centro_costo }}
                                        </td>
                                        <!--<td
                                            class="{{ $user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do and $user_model->profile_id == 2) ? '' : 'none' }} text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ $notification->jefe_inmediato }}
                                        </td>-->
                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ $notification->tipo_novedad }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($notification->started_date)->translatedFormat('j F, Y') }}
                                            {{ \Carbon\Carbon::parse($notification->started_time)->translatedFormat('h:i:s A') }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($notification->finish_date)->translatedFormat('j F, Y') }}
                                            {{ \Carbon\Carbon::parse($notification->finish_time)->translatedFormat('h:i:s A') }}
                                        </td>

                                        @if ($user_model->center_cost_id == 9 && $user_model->profile_id == 1)
                                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">


                                                <form action="{{ route('notifications.destroy', $notification->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><span class="material-icons"
                                                            style="color:red; font-size:26px">delete</span></button>
                                                </form>



                                            </td>
                                        @endif

                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            @if ($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || $user_model->id == $notification->user_id)
                                                <a class=""
                                                    href="./extraHours/{{ $notification->id }}/edit"><span
                                                        class="material-icons"
                                                        style="color:blue; font-size:26px">edit</span></a>
                                            @else
                                                <a class="none"
                                                    href="./extraHours/{{ $notification->id }}/edit"><span
                                                        class="material-icons"
                                                        style="color:blue; font-size:26px">edit</span></a>
                                            @endif

                                        </td>

                                        <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                            <a href="{{ route('extrahours.show', $notification->id) }}"><span
                                                    class="material-icons"
                                                    style="color:green; font-size:26px">preview</span></a>
                                        </td>



                                    </tr class="bg-white border-b">
                                @endforeach
                            </tbody>




                        </table>
                    </div>
                </div>
            </div>
        </div>


        @if (count($extrahours) > 0)
            {{ count($extrahours) > 0 ? $extrahours->appends(['b_fecha_inicio' => $b_fecha_inicio, 'b_fecha_final' => $b_fecha_final])->links() : '' }}
        @else
            @livewire('alert')
        @endif

        <div class="grid  text-center">







        </div>



        <div class="grid grid-cols-3 text-center mb-5">

            <div>
                <button
                    class="bg-transparent mt-10 hover:bg-indigo-500 text-indigo-700 font-semibold hover:text-white py-2 px-4 border border-indigo-500 hover:border-transparent rounded">
                    <a href='{{ url("/excel/{$b_fecha_inicio}/{$b_fecha_final}/7") }}'>Generar reporte por fechas </a>
                </button>
            </div>

            <div>
                <button
                    class="bg-transparent mt-10 hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    <a href='{{ url("/excel/") }}'>Generar Reporte </a>
                </button>
            </div>

            <div> <button
                    class="bg-transparent mt-10 hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                    <a href="{{ route('notifications.create') }}">Crear novedad </a>
                </button>
            </div>
        </div>




    </div>
    @push('scripts')
        <script>
            let submit = document.getElementById("formSearch");
            submit.addEventListener("submit",
                function(event) {
                    let f_inicio = document.getElementById("b_fecha_inicio").value;
                    let f_final = document.getElementById("b_fecha_final").value;
                    console.log(f_inicio)

                    if (Date.parse(f_inicio) > Date.parse(f_final)) {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'La fecha de inicio es mayor que la de final.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(f_inicio)
                        event.preventDefault();
                    }
                });
        </script>
    @endpush



</x-app-layout>
