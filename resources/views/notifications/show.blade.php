<x-app-layout>

    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-lg mx-auto mt-10">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                    @if (session('success'))
                    <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                      <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                      <div>
                        <span class="font-medium">{{ session('success') }}</span> 
                      </div>
                    </div>
                   
                  @endif
                    <tr class="bg-gray-800 border-b rounded border" style="position: relative">

                      <td colspan="2" class="text-white px-4 py-2"> Detalles
                          <a href="{{ route('notifications.index') }}">
                            <span class="material-icons" style="color:white; font-size:26px ; position:absolute; left:10px">home</span></a>
                          <a href="{{ url()->previous()}}">
                            <span class="material-icons" style="color:white; font-size:26px ; position:absolute; right:10px">arrow_back</span>
                            <span class="material-symbols-outlined">

                                </span>
                          </a>
                     </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                           Soporte entregado
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">

                        {{$notification->support ? 'Entregado' : 'No entregado'}}

                        </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                           Tipo de identificación
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">

                        {{$notification->identificationType->name}}

                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                          Identification
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">
                            {{ $notification->Employee->identification}}
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        Empleados
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $notification->Employee->first_name}}  {{ $notification->Employee->last_name}}
                      </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        cargo
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $notification->Employee->position->name}}
                      </td>
                    </tr>


                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        Jefe Inmedianto
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $notification->boss->fullname}}
                      </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Centro de costo</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         {{$notification->centerCost->name}}
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Tipo de novedad</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{$notification->notificationType->name}}
                      </td>
                    </tr class="bg-white border-b">

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Fecha de inicio</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{\Carbon\Carbon::parse($notification->started_date )->translatedFormat('j F, Y h:i:s A')}}
                      </td>
                    </tr class="bg-white border-b">


                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Fecha de Finalizacion</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{  \Carbon\Carbon::parse($notification->finish_date )->translatedFormat('j F, Y h:i:s A') }}
                      </td>
                    </tr class="bg-white border-b">

                    @if($notification->total_hours > 8)
                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de dias</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ round($notification->total_days,0) }}
                    </td>
                    </tr class="bg-white border-b">
                    @endif
                   

                    @if($notification->total_hours <= 8)
                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de horas permisos</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ $notification->total_hours >= 8 ? $notification->total_hours - 1 : $notification->total_hours }}
                      </td>
                    </tr>
                    @endif
                   

                    @if($notification->total_hours > 8)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de Horas laboradas</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         {{ round($notification->business_days,0) }}
                        </td>
                      </tr>
                    @endif

                    <tr class="bg-white border-b">
                      <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Observaciones</td>

                    </tr class="bg-white border-b">

                    <tr class="bg-white border-b">
                      <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $notification->observation}}</td>

                    </tr class="bg-white border-b">


                  </table>
                </div>
              </div>
            </div>
          </div>


     </div>
     <div class="container mx-auto">

       <div class="grid grid-cols-2 max-w-lg mx-auto text-center">
           <div class="">
               <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-40"> <a href="{{route('notifications.edit',$notification) }}">Editar</a> </button>
            </div>
           <div class="mb-10">
            <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> <a href="{{ url()->previous()}}">Regresar</a> </button>
           </div>


       </div>



    </div>



</x-app-layout>
