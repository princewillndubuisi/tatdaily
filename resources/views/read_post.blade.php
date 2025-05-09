@extends('layout.app')

@section('title')
    Post
@endsection

@section('content')
    {{-- Start Main post section --}}
    <div class="w-11/12 mx-auto sm:w-11/12 sm:mx-auto mt-10">
        <div class="flex justify-between  gap-10 w-full">
            <div class="w-full sm:w-[65%] sm:h-1080">
                <div class="">
                    {{-- <a class="border border-orange-100 rounded-full py-1 px-4 font-medium text-sm bg-orange-100 mr-4" href="">Tech trends</a> --}}
                    <a class="border border-orange-100 rounded-full  py-1 px-4 font-medium text-sm bg-orange-100"
                        href="">{{ $post->category->title }}</a>
                </div>
                <div class="flex items-center font-medium gap-2 mt-2 text-gray-500">
                    @php
                        $date = \Carbon\Carbon::parse($post->created_at);
                        $isToday = $date->isToday();
                        $formattedDate = $isToday ? 'Today' : $date->format('jS F, Y');
                        $relativeTime = $date->diffForHumans();
                    @endphp

                    <p class="font-bold text-[10px] sm:text-2xl">Written by {{ $post->name }}</p>
                    <p class="font-bold text-[10px] mb-2.5 sm:text-2xl">.</p>
                    <p class="font-bold text-[10px] sm:text-2xl">{{ $formattedDate }}</p>
                    <p class="font-bold text-[10px] mb-2.5 sm:text-2xl">.</p>
                    <p class="font-bold text-[10px] sm:text-2xl">{{ $relativeTime }}</p>
                </div>
                <div class="flex items-center font-medium gap-4 text-black ">
                    <a class="border border-orange-100 text-[10px] rounded-full px-6 font-medium sm:text-sm bg-slate-200 sm:py-1"
                        href="">Level 1</a>
                    <p class="font-bold mb-4 text-3xl">.</p>
                    <a href="" class="text-blue-400 text-lg">Follow</a>
                </div>
                <div class="mt-2">
                    <h1 class="text-[16px] sm:text-4xl font-semibold">{{ $post->title }}</h1>
                </div>
                <div class="w-full h-[270px] mt-8 border sm:w-full sm:h-[548px]">
                    <img class="w-full h-full rounded-md sm:rounded-md" src="{{ $post->image }}" alt="">
                </div>
                <div
                    class="mt-8 w-full text-[14px] text-gray-600 leading-relaxed tracking-wider text-justify sm:text-lg post-content">
                    {!! preg_replace('/<img[^>]+\>/i', '', $post->body) !!}
                </div>

                <div class="">
                    @if ($post->video)
                        @php
                            if (filter_var($post->video, FILTER_VALIDATE_URL)) {
                                preg_match(
                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i',
                                    $post->video,
                                    $matches,
                                );
                                $videoId = $matches[1] ?? null;
                            } else {
                                $videoId = null;
                                $localVideo = asset('storage/videos/' . $post->video);
                            }
                        @endphp

                        @if ($videoId)
                            {{-- YouTube Video --}}
                            <div class="w-full h-[270px] mt-8 aspect-video sm:w-full sm:h-[548px]  sm:rounded-md">
                                <iframe class="w-full h-full rounded-md sm:rounded-md"
                                    src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        @elseif (!empty($post->video) && file_exists(public_path('storage/videos/' . $post->video)))
                            {{-- Local Video --}}
                            <div class="w-full h-[270px] mt-8 aspect-video sm:w-full sm:h-[548px] sm:rounded-md">
                                <video class="w-full h-full rounded-md sm:rounded-md" controls>
                                    <source src="{{ $localVideo }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @else
                        <div class="my-4">
                        </div>
                    @endif
                </div>


                <div class="w-[90%] mx-auto mt-8 sm:w-[90%] sm:mx-auto sm:mt-2">
                    <div class="flex justify-between items-center gap-4 px-3">
                        <div class="">
                            <i class="fa-solid fa-thumbs-up text-gray-600 text-3xl mr-3"></i>
                            <span class="text-gray-600 text-xl font-semibold ml-1">{{ $post->likes()->count() }}</span>
                        </div>
                        <div class="py-2 px-4">
                            <i class="fa-solid fa-comments text-gray-600 text-3xl mr-3"></i>
                            <span class="text-gray-600 text-xl font-semibold ml-1">{{ $post->comments()->count() }}</span>
                        </div>
                        <div class="py-2 px-4">
                            <a href="#"
                                onclick="sharePost('{{ $post->id }}', '{{ $post->title }}', '{{ asset('storage/' . $post->image) }}')">
                                <i class="fa-solid fa-share-nodes text-gray-600 text-3xl mr-5"></i>
                                {{-- <span class="text-gray-600 text-xl font-semibold ml-1">10.0K </span> --}}
                            </a>

                        </div>
                    </div>
                </div>

                {{-- Start comments --}}
                <livewire:post-comments :key="'comments' . $post->id" :$post />
                {{-- End comments --}}
            </div>


            <div class="w-[28%] mt-40 hidden sm:block">
                <div class="">
                    <h1 class="text-3xl font-semibold">Follow posts by creator</h1>
                </div>

                {{-- <div class="mt-8">
                    <div class="w-[100%] h-64">
                        <img class="w-full h-full" src="{{asset('images/ecommerce-2140604_1280.jpg')}}" alt="">
                    </div>

                    <div class="flex items-center gap-4 font-medium text-sm text-black ">
                        <p class="font-bold">Written by {{$post->name}}</p>
                        <p class="font-bold mb-3 text-2xl">.</p>
                        <p class="font-bold">{{$formattedDate}}</p>
                    </div>

                    <div class="text-xl font-semibold">
                        Lorem, ipsum dolor sitted
                    </div>

                    <div class="mt-1">
                        <p class="text-xl text-slate-600 leading-relaxed font-semibold">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, facere eos fugit aliquam ut modi optio earum facilis dolores sed nisi sit
                        </p>
                    </div>

                    <div class="mt-2">
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200 ml-2" href="">
                            Entertainment
                        </a>
                    </div>
                </div>

                <div class="mt-16">
                    <div class="w-[100%] h-64">
                        <img class="w-full h-full" src="{{asset('images/ecommerce-2140604_1280.jpg')}}" alt="">
                    </div>

                    <div class="flex items-center gap-4 font-medium text-sm text-black ">
                        <p class="font-bold">Written by {{$post->name}}</p>
                        <p class="font-bold mb-3 text-2xl">.</p>
                        <p class="font-bold">{{$formattedDate}}</p>
                    </div>

                    <div class="text-xl font-semibold">
                        Lorem, ipsum dolor sitted
                    </div>

                    <div class="mt-1">
                        <p class="text-xl text-slate-600 leading-relaxed font-semibold">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, facere eos fugit aliquam ut modi optio earum facilis dolores sed nisi sit
                        </p>
                    </div>

                    <div class="mt-2">
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200 ml-2" href="">
                            Entertainment
                        </a>
                    </div>
                </div>

                <div class="mt-16">
                    <div class="w-[100%] h-64">
                        <img class="w-full h-full" src="{{asset('images/ecommerce-2140604_1280.jpg')}}" alt="">
                    </div>

                    <div class="flex items-center gap-4 font-medium text-sm text-black ">
                        <p class="font-bold">Written by {{$post->name}}</p>
                        <p class="font-bold mb-3 text-2xl">.</p>
                        <p class="font-bold">{{$formattedDate}}</p>
                    </div>

                    <div class="text-xl font-semibold">
                        Lorem, ipsum dolor sitted
                    </div>

                    <div class="mt-1">
                        <p class="text-xl text-slate-600 leading-relaxed font-semibold">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, facere eos fugit aliquam ut modi optio earum facilis dolores sed nisi sit
                        </p>
                    </div>

                    <div class="mt-2">
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                        <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200 ml-2" href="">
                            Entertainment
                        </a>
                    </div>
                </div> --}}

                @foreach ($otherPosts as $otherPost)
                    @php
                        $otherdate = \Carbon\Carbon::parse($otherPost->created_at);
                        // $Date = $NotToday ? 'Today' : $date->format('jS F, Y');
                        $Time = $otherdate->diffForHumans();
                    @endphp

                    <div class="mt-16">
                        <div class="w-[100%] h-64">
                            <img class="w-full h-full rounded-md" src="{{ $otherPost->image }}" alt="">
                        </div>

                        <div class="flex items-center gap-4 font-medium text-sm text-black ">
                            <p class="font-bold">Written by {{ $otherPost->name }}</p>
                            <p class="font-bold mb-3 text-2xl">.</p>
                            <p class="font-bold">{{ $Time }}</p>
                        </div>

                        <a href="{{ route('read.post', $otherPost->id) }}"
                            class="text-xl font-semibold hover:text-slate-500">
                            {{ $otherPost->title }}
                        </a>

                        <div class="mt-1">
                            <p class="text-xl text-gray-600 leading-relaxed">
                                {{ $otherPost->description }}
                            </p>
                        </div>

                        <div class="mt-2">
                            <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200"
                                href="">{{ $otherPost->category->title }}</a>
                            {{-- <a class="border border-sky-100 rounded-full py-1 px-4 font-medium text-sm bg-sky-200 ml-2" href="">
                                Entertainment
                            </a> --}}
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    {{-- End Main post section --}}
@endsection

@push('script')
    <script>
        function sharePost(postId, postTitle, postImage) {
            const postUrl = "{{ url('/read_post') }}/" + postId;

            if (navigator.share) {
                navigator.share({
                        title: postTitle,
                        text: postTitle,
                        url: postUrl
                    }).then(() => console.log('Post shared successfully'))
                    .catch((error) => console.error('Error sharing:', error));
            } else {
                alert("Your browser doesn't support native sharing. Try copying the link: " + postUrl);
            }
        }
    </script>
@endpush
