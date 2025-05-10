<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
             /* Soft neutral background */
             /* Dark blue-black text */
        }

        .font-cheltenham {
            font-family: 'Cheltenham Pro', serif;
        }


        @font-face {
            font-family: 'Cheltenham Pro';
            src: url('/fonts/cheltenham-pro.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif;

             /* Deep Teal for headings */
        }

        /* Navigation */
        .header {
            background-color: #212A31; /* Dark navy */
        }
        nav ul li a {

            transition: color 0.3s ease;
        }
        nav ul li a:hover {
            color: #124E66;
        }

        /* Buttons */
        .btn-login {
            color: #124E66;
            border: 2px solid #2E3944;
            padding: 8px 18px;
            transition: all 0.3s ease-in-out;
        }
        .btn-login:hover {
            background-color: #2E3944;
            color: #D3D9D4;
        }
        .btn-signup {
            background-color: #124E66;
            color: #D3D9D4;
            border: 2px solid #124E66;
            padding: 8px 18px;
            transition: all 0.3s ease-in-out;
        }
        .btn-signup:hover {
            background-color: #2E3944;
        }

        /* Footer */
        .footer {
            background: #212A31;
            color: #D3D9D4;
            text-align: center;
            padding: 20px 0;
            font-size: 18px;
        }
        .footer a {
            color: #D3D9D4;
            margin: 0 10px;
            transition: color 0.3s ease-in-out;
        }
        .footer a:hover {
            color: #124E66;
        }

        .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            padding-bottom: 64px !important;
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }
        .swiper-pagination-bullet {
            background: #D0CECD;
        }
        .swiper-pagination-bullet-active {
            background: #D0CECD;
        }

        @media screen and (max-width: 1200px) {
            html {
                font-size: 55%;
            }
        }

         /* Add this CSS without changing your JS */
        .slider a {
            position: relative;
            z-index: 10; /* Higher than buttons */
        }

        /* Make sure slider items can be clicked */
        .slider > div {
            pointer-events: auto;
        }

        /* Buttons container doesn't block clicks */
        .pointer-events-none {
            pointer-events: none;
        }

        /* Buttons themselves are clickable */
        .pointer-events-auto {
            pointer-events: auto;
        }

         /* CKEditor Styling */
         .ck-editor__editable {
            min-height: 450px;
            background-color: #343a40 !important;
            color: white !important;
            border: 1px solid #495057 !important;
            padding: 15px !important;
        }

        .ck-toolbar {
            background-color: #1a202c !important;
            border: 1px solid #495057 !important;
            border-bottom: none !important;
        }

        .ck-button {
            color: white !important;
        }

        .ck-button:not(.ck-disabled):hover {
            background-color: #2d3748 !important;
        }

        .ck-dropdown__panel {
            background-color: #1a202c !important;
            border: 1px solid #495057 !important;
        }

        .ck-list__item:hover {
            background-color: #2d3748 !important;
        }

        .ck-placeholder {
            color: #b0b0b0 !important;
        }

        .ck-editor__editable {
            min-height: 350px !important;
        }

        .post-content ol {
            list-style-type: decimal;
            padding-left: 20px;
            margin: 1em 0;
        }
        .post-content ol li {
            margin-bottom: 0.5em;
        }
        .post-content ul {
            list-style-type: disc;
            padding-left: 20px;
            margin: 1em 0;
        }

        a {
            pointer-events: auto;
            position: relative;
            z-index: 10;
        }


        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, rgba(59, 130, 246, 0.3) 50%, transparent 100%);
        }

                .title-underline {
            position: relative;
        }

        .title-underline:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 2px;
            right: 0;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: width 0.4s ease;
        }

        .title-underline:hover:after {
            width: 100%;
            left: 0;
        }

    </style>
</head>
<body class="font-sans">
    {{-- Start Header section --}}
    <header id="page-top" class="bg-white z-50 fixed top-0 left-0 right-0 sm:static">
        {{-- Start nav section --}}
        <nav class="w-11/12 mx-auto h-auto sm:h-40 sm:border-b-2 sm:border-black sm:mt-2">

            {{-- Desktop Search and Auth --}}
            <div class="hidden sm:flex sm:justify-between sm:items-center">
                <div x-data="{ showSearch: false, query: '' }" class="sm:relative sm:flex sm:items-center sm:gap-2">
                    <button
                        class="rounded-md px-2 py-1 transition-all duration-300 ease-in-out hover:bg-slate-50 hover:scale-105"
                        x-on:click="showSearch = !showSearch"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <div
                        class="flex items-center ml-2 transition-all duration-300"
                        :class="{ 'opacity-100 visible': showSearch, 'opacity-0 invisible': !showSearch }"
                    >
                        <input
                            x-model="query"
                            type="text"
                            class="border px-2 py-1 rounded w-48 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            placeholder="Search..."
                        >
                        <button
                            class="ml-2 border px-2 py-1 rounded bg-gray-400 border-gray-400 text-white"
                            x-on:click="$dispatch('search', { search: query })"
                        >
                            GO
                        </button>
                    </div>
                </div>

                {{-- Auth Buttons - Desktop --}}
                <div class="hidden sm:flex items-center gap-4">
                    @auth
                        <x-app-layout />
                    @else
                        <a href="{{ route('login') }}">
                            <button class="text-white bg-gray-500 py-1 px-2 rounded border border-gray-600 font-bold text-sm transition-all duration-300 ease-in-out hover:bg-gray-600">
                                SIGN IN
                            </button>
                        </a>
                        <a href="{{ route('register') }}">
                            <button class="text-white bg-gray-500 py-1 px-2 rounded border border-gray-600 font-bold text-sm transition-all duration-300 ease-in-out hover:bg-gray-600">
                                SIGN UP
                            </button>
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:block sm:text-center">
                <h1 class="sm:text-[50px] font-medium text-black font-cheltenham">
                    THE ACADEMIC TIMES
                </h1>
            </div>


            {{-- Heading and Hamburger - Mobile --}}
            <div class="sm:hidden pt-4">

                <div class="flex items-center justify-between px-4 w-full mx-auto">
                    <!-- Hamburger -->
                    <button class="rounded-md px-2 py-1 transition-all duration-300 ease-in-out hover:bg-slate-50 hover:scale-105" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="w-8 h-8 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    {{-- Mobile Menu --}}
                    <div x-data="{ query: '' }" id="mobile-menu" class="sm:hidden hidden z-50 px-4 py-4 absolute top-20 w-[335px]  rounded-md bg-white">
                        <ul class="flex flex-col gap-4 font-semibold text-xl text-slate-700">
                            {{-- Mobile Search --}}
                            
                            <div
                                class="flex items-center gap-2 transition-all duration-300"

                            >
                                <input
                                    x-model="query"
                                    type="text"
                                    class="border px-4 py-3 text-xl rounded w-48 focus:outline-none focus:ring-1 focus:ring-gray-400"
                                    placeholder="Search..."
                                >
                                <button
                                    class="border px-4 py-3 text-xl rounded bg-gray-400 border-gray-400 text-white"
                                    x-on:click="$dispatch('search', { search: query })"
                                >
                                    GO
                                </button>
                            </div>

                            <li><a href="{{ url('/') }}" class="text-2xl block hover:text-indigo-600">Home</a></li>
                            <li><a href="{{ route('career') }}" class="text-2xl block hover:text-indigo-600">Career</a></li>
                            <li><a href="#" class="text-2xl block hover:text-indigo-600">About Us</a></li>


                        </ul>
                    </div>

                    <div class="flex items-center gap-4 sm:hidden">
                        @auth
                            <x-app-layout />
                        @else
                            <a href="{{ route('login') }}">
                                <button class="text-white bg-gray-500 text-md py-2 px-3 sm:py-1 sm:px-2 rounded border border-gray-600 font-bold sm:text-sm transition-all duration-300 ease-in-out hover:bg-gray-600">
                                    SIGN IN
                                </button>
                            </a>
                            <a href="{{ route('register') }}">
                                <button class="text-white bg-gray-500 text-md py-2 px-3 sm:py-1 sm:px-2 rounded border border-gray-600 font-bold sm:text-sm transition-all duration-300 ease-in-out hover:bg-gray-600">
                                    SIGN UP
                                </button>
                            </a>
                        @endauth
                    </div>
                </div>
                <!-- Heading -->
                <h1 class="text-[25px] my-8 text-center font-medium text-black font-cheltenham">
                    THE ACADEMIC TIMES
                </h1>
            </div>


            {{-- Desktop Navigation --}}
            <div class="hidden sm:block sm:ml-10 mt-2">
                <ul class="font-semibold text-xl flex justify-center gap-x-10 text-slate-600">
                    <li><a href="{{ url('/') }}" class="hover:text-slate-800">Home</a></li>
                    <li><a href="{{ route('career') }}" class="hover:text-slate-800">Career</a></li>
                    <li><a href="#" class="hover:text-slate-800">About Us</a></li>
                </ul>
            </div>
        </nav>

        <hr class="hidden sm:block sm:mt-[0.5px] sm:w-11/12 sm:mx-auto sm:border-black sm:border-t-2">

        {{-- End nav section --}}
    </header>


    {{-- End Header section --}}

    @yield('content')


    @guest
        <div class="fixed bottom-8 right-8 z-10">
            <a href="{{ route('login') }}" class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-blue-500 shadow-lg flex items-center justify-center text-white hover:shadow-xl transition-all transform hover:scale-110">
                <i class="fas fa-plus text-xl"></i>
            </a>
        </div>
    @endguest

    @auth
        @if (Auth::user()->usertype == 'user')
                <!-- Floating Action Button for users -->
                <div class="fixed bottom-8 right-8 z-10">
                    <a href="{{ route('career.apply') }}" class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg flex items-center justify-center text-white hover:shadow-xl transition-all transform hover:scale-110">
                        <i class="fas fa-plus text-xl"></i>
                    </a>
                </div>

        @elseif (Auth::user()->usertype == 'editor')
                <!-- Floating Action Button for editors -->
                <div class="fixed bottom-8 right-8 z-10">
                    <a href="{{ route('create.post') }}" class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg flex items-center justify-center text-white hover:shadow-xl transition-all transform hover:scale-110">
                        <i class="fas fa-plus text-xl"></i>
                    </a>
                </div>
        @endif
    @endauth


    {{-- Start Footer section --}}
    <div class="border bg-black h-24 ">
        <div class="text-white font-medium text-3xl w-[70%] mx-auto mt-6 gap-4 flex items-center justify-center">
            <p>© 2025</p>
            <a href=""><i class="fa-brands fa-square-facebook"></i></a>
            <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
            <a href=""><i class="fa-regular fa-envelope"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>
    {{-- End Footer section --}}

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="editor-sdk.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script type="module" src="https://unpkg.com/@material-tailwind/html@latest/scripts/popover.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('script')

    <script>
        ClassicEditor
            .create(document.getElementById('editor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'bulletedList', 'numberedList', 'alignment', '|',
                        'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                        'imageUpload', '|',  // Add image upload button
                        'undo', 'redo'
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative', '|',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side', '|',
                        'toggleImageCaption'
                    ],
                    styles: [
                        'inline',
                        'block',
                        'side'
                    ]
                },
                ckfinder: {
                    uploadUrl: "{{ route('upload.image') }}?_token={{ csrf_token() }}",
                    // Optional: Add headers if needed
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                }
            })
            .then(editor => {
                console.log('Editor ready');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>
</html>
