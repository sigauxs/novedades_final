<x-app-layout>
    <div class="container mx-auto">
        <div class="flex flex-col">

          @if (session('success'))
          <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
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
                        class="{{ ($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do AND $user_model->profile_id == 2) ) ? '' : 'none' }}  text-sm font-medium text-white px-4 py-2">
                          Centro de costos
                        </th>
                        <th scope="col"
                        class="{{ ($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do AND $user_model->profile_id == 2) ) ? '' : 'none' }}  text-sm font-medium text-white px-4 py-2">
                            Jefe de inmediato
                        </th>
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
                     @foreach ($notifications as $notification)
                        <tr class="bg-white border-b {{$notification->support ? '' : 'bg-red-200'}}">

                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1  }}</td>
                         
                           <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                            {{$notification->nombres}}  {{$notification->apellidos}}
                            </td>


                          <td class="
                           {{ ($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do AND $user_model->profile_id == 2) ) ? '' : 'none' }}
                           text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                            {{$notification->centro_costo}}
                          </td>
                            <td class="{{ ($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || ($user_model->center_cost_id == $do AND $user_model->profile_id == 2) ) ? '' : 'none' }} text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                              {{$notification->jefe_inmediato}}
                            </td>
                          <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                            {{$notification->tipo_novedad}}
                          </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{\Carbon\Carbon::parse($notification->started_date)->translatedFormat('j F, Y h:i:s A')}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                                {{\Carbon\Carbon::parse($notification->finish_date)->translatedFormat('j F, Y h:i:s A')}}
                            </td>

                            @if($user_model->center_cost_id == 9 && $user_model->profile_id == 1 )
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                              
                              
                              <form action="{{ route('notifications.destroy', $notification->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit"><span class="material-icons" style="color:red; font-size:26px">delete</span></button>
                              </form>
                              
                             
                              
                            </td>
                            @endif
                       
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                              @if($user_model->center_cost_id == 9 || $user_model->profile_id == 1 || $user_model->id == $notification->user_id )
                                <a class="" href="{{ route('notifications.edit', $notification->id ) }}"><span class="material-icons" style="color:blue; font-size:26px">edit</span></a>     
                              @else
                              <a class="none" href="{{ route('notifications.edit', $notification->id ) }}"><span class="material-icons" style="color:blue; font-size:26px">edit</span></a>     
                              @endif
                              
                            </td>

                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                              <a href="{{ route('notifications.show', $notification->id ) }}"><span class="material-icons" style="color:green; font-size:26px">preview</span></a>
                            </td>



                          </tr class="bg-white border-b">
                        @endforeach
                    </tbody>




                  </table>
                </div>
              </div>
            </div>
          </div>


          <div class="grid grid-cols-2 text-center">

          <div>
            <button class="bg-transparent mt-10 hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                <a href="{{ url("/excel") }}">Generar Excel </a>
            </button>
          </div>
          <div>    <button class="bg-transparent mt-10 hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
            <a href="{{ route('notifications.create') }}">Crear novedad </a>
        </button>
    </div>
          </div>




    </div>




</x-app-layout>
