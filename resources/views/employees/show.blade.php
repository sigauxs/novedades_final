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

    /report/employee

    <button class="bg-transparent mt-10 hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
        <a href="{{ route('employee.pdf', $employee->id ) }}">Generar Excel </a>
    </button>

    <a href={{ url("/pdf/{$employee->id}") }}>pdf</a>
    </div>
</x-app-layout>
