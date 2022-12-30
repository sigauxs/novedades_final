<x-app-layout>

    <div class="container mx-auto">

        {!! Form::model($employee, ['route' => [ 'employees.update', $employee->id ],'method'=>'put','class'=>'w-full max-w-lg mx-auto mt-10']) !!}

        

        {!! Form::close() !!}
    
    </div>

</x-app-layout>