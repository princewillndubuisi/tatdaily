<nav x-data="{ open: false }" class="-ms-5">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between">
            {{-- User --}}
            @if (Auth::user()->usertype == 'user')
                <div class="flex items-center">
                    <!-- Navigation Links -->
                    <div class="">
                        <a href="{{route('career.apply')}}" class="text-fuchsia-950 py-3 px-4 bg-white rounded-lg border-2 border-fuchsia-400 font-semibold text-xl ">Create a post?</a>
                    </div>

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center ms-8 ">
                        <div class="shrink-0 flex items-center ms-8 ">
                            <img class="w-12 h-12 rounded-full shadow hover:shadow-lg hover:border-blue-500" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="">
                        </div>
                    </div>
                </div>

            {{-- Editor --}}
            @elseif (Auth::user()->usertype == 'editor')
                <div class="flex items-center">
                    <!-- Navigation Links -->
                    <div class="">
                        <a href="{{route('create.post')}}" class="text-fuchsia-950 py-3 px-4 bg-white rounded-lg border-2 border-fuchsia-400 font-semibold text-xl ">Create a post</a>
                    </div>

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center ms-8 ">
                        <img class="w-12 h-12 rounded-full shadow hover:shadow-lg hover:border-blue-500" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="">
                    </div>
                </div>

            {{-- Admin --}}
            @elseif (Auth::user()->usertype == 'admin')
                <div class="shrink-0 flex items-center ms-8 ">
                    <img class="w-12 h-12 rounded-full shadow hover:shadow-lg hover:border-blue-500 hover:w-14 hover:h-14" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="">
                </div>
            @endif


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::user()->usertype == 'editor')
                            <x-dropdown-link :href="route('profiles')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                        @elseif (Auth::user()->usertype == 'user')
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Change Picture Form (Visible only as the "Change Picture" link) -->
                        <form method="POST" action="{{ route('update.picture') }}" enctype="multipart/form-data" style="display:none;" id="change-picture-form">
                            @csrf
                            <input type="file" id="profile-picture-input" name="photo" accept="image/*" onchange="document.getElementById('change-picture-form').submit();">
                        </form>

                        <!-- Change Picture Link -->
                        <x-dropdown-link href="#" onclick="document.getElementById('profile-picture-input').click(); return false;">
                            {{ __('Change Picture') }}
                        </x-dropdown-link>

                        @if (Auth::user()->usertype == 'admin')
                            <x-dropdown-link :href="url('/')">
                                {{ __('Home') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="flex shadow-2xl bg-white z-50 absolute top-0 right-0 rounded-md  w-[93px] h-[97px] mt-20 border mr-4 sm:hidden ">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex gap-4 px-4 border-b-2 border-gray-300 w-[81px] mx-2">
                <i class='bx bxs-user-circle text-gray-400 mt-2'></i>
                <div>
                    <div class="font-medium text-[10px] text-black">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-[10px] text-black overflow-hidden text-ellipsis whitespace-nowrap w-[63px]">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 bg-white">
                @if (Auth::user()->usertype == 'editor')
                    <x-responsive-nav-link :href="route('profiles')" class="text-black">
                        <div class="flex gap-4 items-center font-medium text-[10px] border-b-2 border-gray-300">
                            <i class='bx bx-user text-gray-400'></i>
                            {{ __('Profile') }}
                        </div>
                    </x-responsive-nav-link>

                @elseif (Auth::user()->usertype == 'user')
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-black">
                        <div class="flex gap-4 items-center font-medium text-[10px]">
                            <i class='bx bx-user text-gray-400'></i>
                            {{ __('Profile') }}
                        </div>
                    </x-responsive-nav-link>
                @endif

                <!-- Change Picture Form (Visible only as the "Change Picture" link) -->
                <form method="POST" action="{{ route('update.picture') }}" enctype="multipart/form-data" style="display:none;" id="change-picture-form">
                    @csrf
                    <input type="file" id="profile-picture-input" name="photo" accept="image/*" onchange="document.getElementById('change-picture-form').submit();">
                </form>

                <!-- Change Picture Link -->
                <x-dropdown-link href="#" onclick="document.getElementById('profile-picture-input').click(); return false;">
                    <div class="flex gap-4 items-center font-medium text-[10px]">
                        <i class='bx bx-user text-gray-400'></i>
                        {{ __('Picture') }}
                    </div>
                </x-dropdown-link>


{{--
                <form method="POST" action="{{ route('update.picture') }}" enctype="multipart/form-data" style="display:none;" id="change-picture-form">
                    @csrf
                    <input type="file" id="profile-picture-input" name="photo" accept="image/*" onchange="document.getElementById('change-picture-form').submit();">
                </form> --}}
                {{-- <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                        <div class="flex gap-4 items-center font-medium text-[10px]">
                            <i class='bx bx-log-out-circle text-red-500'></i>
                            {{ __('Log Out') }}
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
