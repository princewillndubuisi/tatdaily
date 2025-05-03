<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf



        <div><p class="text-center mt-12 text-lg  mb-6">CREATE YOUR ACCOUNT</p></div>

        <!-- Name -->
        <div>
            <!-- <x-input-label for="name" :value="__('Name')" class="hidden sm:block" /> -->
            <x-text-input id="name" class="block mt-1 w-full sm:w-full " type="text" name="name" :value="old('name')"  placeholder="Name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <!-- <x-input-label for="email" :value="__('Email')" class="hidden sm:block" /> -->
            <x-text-input id="email" class="block mt-1 w-full sm:w-full " type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <!-- <x-input-label for="password" :value="__('Password')" class="hidden sm:block" /> -->

            <x-text-input id="password" class="block w-full mt-1 sm:w-full "
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <!-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="hidden sm:block" /> -->

            <x-text-input id="password_confirmation" class="block w-full mt-1 sm:w-full "
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center  mt-4">


            <x-primary-button class="text-center py-5 w-full  text-lg justify-center sm:w-full bg-green-500 ">
                {{ __('Register') }}
            </x-primary-button>

            <a class=" text-sm text-gray-600 mt-2   rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
