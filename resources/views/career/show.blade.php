@extends('layout.app')

@section('title')
    Career show
@endsection

@section('content')
    <section class="text-gray-600 pt-52 body-font overflow-hidden sm:pt-0">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    {{ $career->title }}
                </h2>
                <div class="md:flex-grow mr-8 mt-2 flex items-center justify-start">
                    @foreach($career->tags as $tag)
                        <span class="inline-block mr-2 tracking-wide text-indigo-500 text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="-my-6">
                <div class="flex flex-wrap md:flex-nowrap">
                    <div class="content w-full md:w-3/4 pr-4 leading-relaxed text-base">
                        {!! $career->content !!}
                    </div>
                    <div class="w-full md:w-1/4 pl-4">
                        <img
                            src="/storage/{{ $career->logo }}"
                            alt="{{ $career->company }} logo"
                            class="max-w-full mb-4"
                        >
                        <p class="leading-relaxed text-base">
                            <strong>Location: </strong>{{ $career->location }}<br>
                            <strong>Company: </strong>{{ $career->company }}
                        </p>
                        <a href="{{route('career.link', $career->slug)}}" class="block text-center my-4 tracking-wide bg-white text-indigo-500 text-sm font-medium title-font py-2 border border-indigo-500 hover:bg-indigo-500 hover:text-white uppercase">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
