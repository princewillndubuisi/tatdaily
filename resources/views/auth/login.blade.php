<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div><p class="text-center mt-12 text-lg mb-6">LOG IN TO YOUR ACCOUNT</p></div>

    <form method="POST" action="{{ route('login') }}" class="w-full sm:w-full">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <div class=" flex flex-col items-center  mt-4 sm:w-[400px]">


            <x-primary-button class=" py-5 flex justify-center w-full bg-green-500" sm:w-full >
                {{ __('Log in') }}
            </x-primary-button>

            <x-primary-button class="mt-4 py-5 w-full flex border border-black-500 justify-center sm:w-full">
            @if (Route::has('password.request'))
                <a class=" text-sm text-white  rounded-md " href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            </x-primary-button>

        </div>
    </form>
    <div><p class="text-center mt-4">Terms and Conditions Applied</p></div>
    <div class="mt-2 text-center"><a href="{{url('register')}}">Dont have an account? Click here to Create one</a></div>
</x-guest-layout>


