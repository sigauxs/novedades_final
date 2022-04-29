<x-app-layout>

    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-lg mx-auto mt-10">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                  
                    <tr class="bg-gray-800 border-b rounded border" style="position: relative">
                      <td colspan="2" class="text-white px-4 py-2"> Detalles  <a href="/notifications"><span class="material-icons" style="color:white; font-size:26px ; position:absolute; right:10px">home</span></a></td>
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

         
     </div>
     <div class="container mx-auto">

       <div class="flex flex-col w-full max-w-lg mx-auto mt-10">
        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-40"> <a href="{{route('notifications.edit',$notification) }}">Editar</a> </button>
        <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> <a href="{{ url()->previous()}}">Regresar</a> </button>
       </div>
     
      

    </div>
    
</x-app-layout>