@extends('layout.app')

@section('title')
    Career
@endsection

@section('content')
    <header class="text-gray-600 body-font  border-gray-100">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="{{ route('career') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">Laravel Job Board</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a href="{{ route('login') }}" class="mr-5 hover:text-gray-900">Employers</a>
            </nav>

            <a href="{{route('career.apply')}}" class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Apply
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </header>

    <section class="text-gray-600 body-font border-b border-gray-100">
        <div class="container mx-auto flex flex-col px-5 pt-16 pb-8 justify-center items-center">
            <div class="w-full md:w-2/3 flex flex-col items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Top jobs in the industry</h1>
                <p class="mb-8 leading-relaxed">Whether you're looking to move to a new role or just seeing what's available, we've gathered this comprehensive list of open positions from a variety of companies and locations for you to choose from.</p>
                <form class="flex w-full justify-center items-end" action="" method="get">
                    <div class="relative mr-4 w-full lg:w-1/2 text-left">
                        <input type="text" id="s" name="s" value="{{request()->get('s')}}" class="w-full bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Search</button>
                </form>
                <p class="text-sm mt-2 text-gray-500 mb-8 w-full">fullstack php, vue and node, react native</p>
            </div>
        </div>
    </section>
    {{-- Start main section --}}
    <section class="container px-5 py-12 mx-auto">
        <div class="mb-12">
            <div class="flex-justify-center">
                @foreach($tags as $tag)
                    <a href="{{route('career', ['tag' => $tag->slug])}}"
                        class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}"
                    >{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="mb-12">
            <h2 class="text-2xl font-medium text-gray-900 title-font px-4">All jobs ({{ $careers->count() }})</h2>
        </div>
        <div class="-my-6">
            @foreach($careers as $career)
                <a
                    href="{{route('career.show', $career->slug)}}"
                    class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $career->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}"
                >
                    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                        <img src="/storage/{{ $career->logo }}" alt="{{ $career->company }} logo" class="w-16 h-16 rounded-full object-cover">
                    </div>
                    <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                        <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $career->title }}</h2>
                        <p class="leading-relaxed text-gray-900">
                            {{ $career->company }} &mdash; <span class="text-gray-600">{{ $career->location }}</span>
                        </p>
                    </div>
                    <div class="md:flex-grow mr-8 flex items-center justify-start">
                        @foreach($career->tags as $tag)
                            <span class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <span class="md:flex-grow flex items-center justify-end">
                        <span>{{ $career->created_at->diffForHumans() }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </section>
    {{-- End main section --}}
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('category-toggle-btn');

        button.addEventListener('click', () => {
            // Toggle the button color
            button.classList.toggle('bg-gray-300'); // Gray color
            button.classList.toggle('bg-black');   // Normal color

            // Toggle the icon color
            const icon = button.querySelector('i');
            icon.classList.toggle('text-white'); // Toggle white color
        });
    });
</script>

@endpush
