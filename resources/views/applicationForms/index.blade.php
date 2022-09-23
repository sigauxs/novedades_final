<x-app-layout>
    {!! Form::open(['route'=>'applicationForms.create','method'=>'get','class'=>'w-full max-w-lg mx-auto mt-10']) !!}
    
        <div class="flex flex-wrap  mb-6 mx-auto">
            @if (session('error'))
            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
              <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
              <div>
                <span class="font-medium">{{ session('error') }}</span> 
              </div>
            </div>
           
          @endif
        <div class="max-w-lg mx-auto text-center">
              {!! Form::text("identification","",["class"=>"form-control",'']) !!}
              {!! Form::button("<span class='material-icons'>search</span>", ['type' => 'submit', 'class' => 'rounded bg-indigo-600 text-white py-2  px-6 w-1/5'] )  !!}
        </div>
        </div>
        <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="grid grid-cols-2 max-w-lg mx-auto text-center">
       
        
        </div>
        </div>
 
            
    {!! Form::close() !!}
</x-app-layout>