<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img style="width: 100px" src="{{'images/logo.png'}}" alt="">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" >
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-jet-button class="ml-4">
                    {{ __('Ingresar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    @push('scripts')
    <script>
 let email = document.querySelector("#email");

     email.addEventListener('change',chargeEmail);


function chargeEmail(e) {


    const  si = "@sigpeconsultores.com.co";
           email.value += si;



        let str = email.value;
        let regex = /@/gi, result, indices = [];
            while ( (result = regex.exec(str)) ) {
                    indices.push(result.index);
                    }

       if(indices.length > 1){

         let cut = email.value.slice(0,indices[1]);
         email.value = cut;
       }
}



    </script>

    @endpush
</x-guest-layout>
