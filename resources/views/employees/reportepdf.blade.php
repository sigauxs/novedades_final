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

    </style>
  
</head>
<body>

    <div class="mx-auto">
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{$employee->first_name }}{{$employee->last_name }}</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">{{$employee->position->name }}</p>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">C.C. {{$employee->identification }}</p>
    </div>

    <div>
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
             @foreach ($notifications as $notification)
                <tr class="bg-white border-b ">

                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1  }}</td>
                 
                   <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                     {{ $notification->started_date}}
                    </td>


                  <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                    {{ $notification->finish_date}}
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
                <td class="text-sm text-gray-900 font-light px-4 py-2 whitespace-nowrap">
                    {{ $notification->support ? "Entregado":"No entregado" }}
             </td>
                                       
                
                  
           

 



                  </tr class="bg-white border-b">
                @endforeach
            </tbody>




          </table>
    </div>
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>