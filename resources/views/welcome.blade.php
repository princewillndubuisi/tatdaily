@extends('layout.app')

@section('title')
    Home
@endsection

@section('content')
    {{-- Start main section --}}
    <main class="bg-prince h-full pt-52 sm:pt-0">
        {{-- <div class="my-2 h-12 flex justify-center items-center">
            <div class="w-11/12 mx-auto flex justify-center items-center">
                <p class="w-[92px] h-[28px] text-[12px] rounded-xl bg-red-500 flex justify-center items-center text-white sm:w-32 sm:rounded-lg sm:py-1 font-semibold sm:text-xl ">Live News</p>
                <marquee class="text-[10px] ml-8 text-dark font-semibold sm:text-xl" behavior="" direction="">
                    @foreach($marq as $marqs)
                        <a href="{{route('read.post', $marqs->id)}}">
                            <strong class="mr-8 hover:underline transition-all duration-300 ease-in-out">
                                {{$marqs->title}}
                            </strong>
                        </a>
                    @endforeach
                </marquee>
            </div>
        </div> --}}

        {{-- Start Trending news section --}}
        <div class="w-11/12 flex justify-between items-center  mx-auto sm:mt-12">
            <div>
                <h6 class="text-4xl font-medium text-black sm:text-4xl ">Latest News</h6>
            </div>

            <div class="sm:hidden">
                <div id="category-toggle-btn" class="w-[44px] h-[37px] border border-slate-500 flex items-center justify-center rounded-lg">
                    <button  class="text-[13px] " data-dropdown-toggle="category-menu" ><i class='bx bx-menu-alt-left text-slate-500' ></i> </button>
                </div>

                <div class="z-50 hidden w-[165px] h-[162px] overflow-y-auto max-h-[200px] border bg-white justify-between px-6 py-8" id="category-menu" style="scrollbar-width: none; -ms-overflow-style: none;">
                    <livewire:category-blog  />

                    {{-- <div class="flex flex-col justify-between">
                        <a class="font-medium text-gray-500" href="">Clear All</a>
                        <a class="font-medium text-gray-500" href="">See All</a>
                    </div> --}}
                </div>
            </div>

        </div>

        <!-- Slider Container (unchanged) -->
        <div class="w-11/12 mx-auto mt-12 grid grid-cols-1 sm:grid-cols-4 gap-4 sm:mt-6 ">
            @foreach ($category as $categorys)
                @php
                    $mediaPosts = $categorys->posts
                        ->filter(function ($post) {
                            return $post->image || $post->video;
                        })
                        ->map(function ($post) {
                            return [
                                'type' => $post->image ? 'image' : 'video',
                                'url' => $post->image ?? $post->video,
                            ];
                        })
                        ->take(5)
                        ->values(); // Take first 5 media items to rotate
                @endphp
        
        
                <div 
                x-data="{
                    medias: @js($mediaPosts),
                    current: 0,
                    init() {
                        setInterval(() => {
                            this.current = (this.current + 1) % this.medias.length;
                        }, 8000); // Change every 4 seconds
                    }
                }"
                class="w-full h-[300px] mb-4 sm:mb-0 relative rounded-[1rem] overflow-hidden fade-in-up group transition-transform duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg"
            >
                <a href="{{ route('category.post', $categorys->id) }}" class="block w-full h-full relative">
            
                    <template x-for="(media, index) in medias" :key="index">
                        <div
                            x-show="current === index"
                            x-transition:enter="transition-opacity duration-1000"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-1000"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 w-full h-full"
                        >
                            <template x-if="media.type === 'image'">
                                <div
                                    class="w-full h-full bg-cover bg-center"
                                    :style="`background-image: url('${media.url}')`"
                                ></div>
                            </template>
            
                            <template x-if="media.type === 'video'">
                                <video
                                    class="w-full h-full object-cover"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                >
                                    <source :src="media.url" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </template>
                        </div>
                    </template>
            
                    <div class="absolute top-0 text-end w-full pr-4 font-bold bg-black/80 text-2xl p-2 text-white sm:bg-black/40 sm:text-sm">
                        {{ Str::upper($categorys->title) }}
                    </div>
                </a>
                </div>
            @endforeach
        
        </div>
        

            <!-- Navigation Buttons - Modified to not block links -->
            {{-- <div class="absolute inset-0 flex items-center justify-between  p-6 pointer-events-none z-[10]">
                <button id="leftButton" class="w-12 h-12 p-1 text-[16px] rounded-full bg-black text-white pointer-events-auto">
                    <i class='bx bxs-chevron-left'></i>
                </button>
                <button id="rightButton" class="w-12 h-12 p-1 text-[16px] rounded-full bg-black text-white pointer-events-auto">
                    <i class='bx bxs-chevron-right'></i>
                </button>
            </div> --}}
        

        {{--End Trending news section --}}

        {{-- Start Your timeline section --}}
        <div class="w-11/12 mx-auto mt-16 sm:w-11/12">
            <div>
                <h6 class="text-4xl font-medium">Your Timeline</h6>
            </div>

            <div class="w-full gap-x-10 mt-8 sm:flex sm:justify-between ">
                {{-- Start Post blog --}}
                <livewire:post-blog />
                {{-- End Post blog --}}



                <div class="w-[28%] hidden sm:block">
                    <div class="h-80 border bg-white flex justify-between px-6 py-8">
                        <livewire:category-blog  />

                        {{-- <div class="flex flex-col justify-between">
                            <a class="font-medium text-gray-500" href="">Clear All</a>
                            <a class="font-medium text-gray-500" href="">See All</a>
                        </div> --}}
                    </div>


                    {{-- <div class="h-80 border bg-white flex justify-between px-6 py-8 mt-8">
                        <div>
                            <p class="font-medium">Viewers favourite</p>
                            <div class="flex items-center gap-6 mt-6">
                                <input type="checkbox" class="w-5 h-5 rounded-md" name="" id="">
                                <label for="" class="text-sm text-princess font-medium">All Contents</label>
                            </div>
                            <div class="flex items-center gap-6 mt-6">
                                <input type="checkbox" class="w-5 h-5 rounded-md" name="" id="">
                                <label for="" class="text-sm text-princess font-medium">Sport News</label>
                            </div>
                            <div class="flex items-center gap-6 mt-6">
                                <input type="checkbox" class="w-5 h-5 rounded-md" name="" id="">
                                <label for="" class="text-sm text-princess font-medium">eSports</label>
                            </div>
                            <div class="flex items-center gap-6 mt-6">
                                <input type="checkbox" class="w-5 h-5 rounded-md" name="" id="">
                                <label for="" class="text-sm text-princess font-medium">Lorem ipsum</label>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between">
                            <a class="font-medium text-gray-500" href="">Clear All</a>
                            <a class="font-medium text-gray-500" href="">See All</a>
                        </div>
                    </div> --}}


                    <div class="hidden relative h-[400px] w-full border-2 rounded-md mt-8 sm:block">
                        @if($adverts && count($adverts) > 0)
                            <x-advert-card :adverts="$adverts" />
                        @else
                            <div class="flex items-center justify-center h-full bg-red-50">
                                <p class="text-red-500 font-bold">NO ADVERTS FOUND!</p>
                                {{-- <ul class="list-disc ml-6 text-red-500">
                                    <li>Database records exist</li>
                                    <li>Files are in storage/app/public</li>
                                    <li>Storage is linked (php artisan storage:link)</li>
                                </ul> --}}
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end items-center mt-4">
                        <a class="flex" href="#page-top">
                            <i class="fa-solid fa-angle-up text-black mt-1.5"></i>
                            <p class="ml-5 font-medium text-gray-500">Back to top</p>
                        </a>
                    </div>
                </div>
            </div>



            {{-- <div class="w-[70%] h-10 border border-yellow-500 my-6">
                <div class="pagination">
                    {{ $post->onEachSide(1)->links() }}
                </div>
            </div> --}}
        </div>
        {{--End Your timeline section --}}
    </main>
    {{-- End main section --}}
@endsection

@push('script')
<script>
    // Categories
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
