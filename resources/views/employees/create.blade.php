<x-app-layout>

    <div class="container mx-auto">

        {!! Form::open(['route'=>'employees.store','class'=>'w-full max-w-lg mx-auto mt-10']) !!}


            @include('employees.partials.form')


        {!! Form::close() !!}
    
    </div>

</x-app-layout>