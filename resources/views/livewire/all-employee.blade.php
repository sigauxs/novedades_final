
    <div class="container mx-auto">




        <input type="text" wire:model="search">
        <input type="text" wire:model="identification">


        <div class="flex flex-col">

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
                          Nombres
                        </th>
                        <th scope="col"
                        class="  text-sm font-medium text-white px-4 py-2">
                       Apellidos
                        </th>
                        <th scope="col"
                        class=" text-sm font-medium text-white px-4 py-2">
                            Cargo
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                          Area
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-4 py-2">
                            Estados
                        </th>


                        <th scope="col" colspan="3" class="text-sm font-medium text-white px-4 py-2">

                        </th>
                      </tr>
                    </thead class="border-b">




                    <tbody>
                     @foreach ($employees  as $employee)
                        <tr class="bg-white border-b ">

                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employee->identification  }}</td>

                           <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                             {{ $employee->first_name}}
                            </td>


                          <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                            {{ $employee->last_name}}
                          </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                           {{ $employee->position->name }}
                            </td>
                          <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                          {{ $employee->centercost->name }}
                          </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                               {{ $employee->status ? "Activo" : "Inactivo" }}
                            </td>




                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">

                                <a class="" href="{{ route('employees.show', $employee->id ) }}"><span class="material-icons" style="color:blue; font-size:26px">edit</span></a>




                            </td>

                            <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                              <a href=""><span class="material-icons" style="color:green; font-size:26px">preview</span></a>
                            </td>



                          </tr class="bg-white border-b">
                        @endforeach
                    </tbody>




                  </table>
                </div>
              </div>
            </div>
          </div>


        {{ $employees->links()}}





        </div>
    </div>



