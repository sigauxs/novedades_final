<x-app-layout>
    <div class="container mx-auto">

        <div class="w-4/6 mx-auto">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg font-medium leading-6 text-gray-900">{{$employee->first_name }}{{$employee->last_name }}</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">{{$employee->position->name }}</p>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">C.C. {{$employee->identification }}</p>
            </div>

          </div>
       </div></div>

   <div>



    {!! Form::open(['url' => '/employeepdf', 'method' => 'get','class'=>'w-full max-w-lg mx-auto mt-10']) !!}
      <div class="max-w-lg mx-auto text-center">
        <div style="display:none">
            {!! Form::text("id",$employee->id,["class"=>"form-control"]) !!}
        </div>

        {!! Form::button("<span class='material-icons'>search</span>", ['type' => 'submit', 'class' => 'rounded bg-indigo-600 text-white py-2  px-6 w-1/5'] )  !!}
     </div>
    {!! Form::close() !!}
    </div>
</x-app-layout>
