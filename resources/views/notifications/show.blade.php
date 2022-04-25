<x-app-layout>

    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-lg mx-auto mt-10">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                  

                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                           Tipo de identificación
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">
                        @switch($notification->type_identification_id)
                          @case(1)
                              Cedula de ciudania
                              @break
                          @case(2)
                             Tarjeta de identidad
                              @break
                          @case(3)
                              Pasaporte
                          @break
                       
                          @default
                              Default case...
                         @endswitch
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
                        Cargo
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $notification->position->name}}
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
                    </tr class="bg-white border-b">

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

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de dias</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ $notification->total_days }}
                      </td>
                    </tr class="bg-white border-b">
                   

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de Horas</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ $notification->total_hours }}
                      </td>
                    </tr class="bg-white border-b">

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

          <div>
            <a href="/notifications">ir</a>
            <a href="{{route('notifications.edit',$notification) }}">editar</a>
          </div>
     </div>
    
</x-app-layout>