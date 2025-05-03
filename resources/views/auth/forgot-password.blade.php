<x-guest-layout>
    
               
 
    <div class="mb-4  text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    

    <form method="POST" action="{{ route('password.email') }}"  class="sm:w-full">
        @csrf

        <!-- Email Address -->
    <div class="sm:w-[400px]">
         <div class="sm:w-full">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2 sm:w-full">
            <x-primary-button class="text-center py-5 text-lg justify-center sm:w-full bg-green-500">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </div>
    
    </form>
</x-guest-layout>
