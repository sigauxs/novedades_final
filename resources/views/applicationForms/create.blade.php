<x-app-layout>
    <div class="container mx-auto">
        
        {!! Form::open(['route'=>'applicationForms.store','class'=>'w-full max-w-lg mx-auto mt-10']) !!}
         @include('applicationForms.partials._form');
        {!!Form::close() !!}
    </div>
  </x-app-layout>
