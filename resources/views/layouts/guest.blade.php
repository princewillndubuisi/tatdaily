<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>



    <body class="font-sans bg-[#D3D9D4] text-gray-900 antialiased">


        <div class="w-11/12 overflow-hidden  mx-auto sm:flex sm:w-11/12 sm:h-svh sm:gap-x-80 sm:mx-0">

            <div class="hidden sm:block">
                <img src="{{asset('images/Rectangle 53.png')}}" class="w-[540px] max-h-full object-cover" alt="">
            </div>



            <div class="w-[327px] mx-auto sm:w-[400px] sm:mx-0">


                 <!-- back button -->
                 <div class="hidden sm:block -ml-52  sn:flex pt-20">
                    <a href="">
                    <i class="fa fa-angle-left pr-1 pt-1 icon-bold"></i>
                    <button class=" font-bold"><a href="{{url('')}}">back</a></button>
                    </a>
                </div>



                {{ $slot }}
            </div>





        </div>
    </body>



</html>
