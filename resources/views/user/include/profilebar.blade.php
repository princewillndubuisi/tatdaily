{{-- Start profilebar --}}
<section class="w-[430px] -ml-6 sm:w-[1195px] ">
    <div class="mb-4 border-b border-gray-200 mt-8">
        <ul class="flex flex-wrap w-[382px] -mb-px text-sm font-medium text-center justify-around sm:w-full sm:justify-evenly" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 border-purple-600" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300" role="tablist">
            <li class="" role="presentation">
                <button href="" class="inline-block p-4 border-b-2 border-gray-200 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Dashboard</button>
            </li>

            <li class="" role="presentation">
                <button class="inline-block p-4 border-b-2 border-gray-200 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Your posts</button>
            </li>

            <li class="hidden sm:block" role="presentation">
                <button class="inline-block p-4 border-b-2 border-gray-200 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Likes and comments</button>
            </li>

            <li class="hidden sm:block" role="presentation">
                <button class="inline-block p-4 border-b-2 border-gray-200 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Bookmark</button>
            </li>
        </ul>
    </div>


    <div id="default-styled-tab-content">
        {{--Start user dashboard--}}
        <div class="hidden sm:p-4 rounded-lg " id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            @if (Session()->has('success'))
                <div id="alert-1" class="flex items-center w-[80%] mx-10 p-4 mb-4 text-blue-800 rounded-lg bg-sky-200 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        <strong>Success!</strong> {{Session('success')}}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-[10px] text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class=" py-3"> # </th>
                            <th scope="col" class=" py-3"> Title </th>
                            <th scope="col" class=" py-3"> Description </th>
                            <th scope="col" class=" py-3"> Body </th>
                            <th scope="col" class=" py-3"> Post by </th>
                            <th scope="col" class=" py-3"> Category </th>
                            <th scope="col" class=" py-3"> Status </th>
                            <th scope="col" class=" py-3"> Image </th>
                            <th scope="col" class=" py-3"> Video </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datas)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row">{{$datas->id}}</th>
                                <td>{{$datas->title}}</td>
                                <td class="overflow-hidden" style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">{{$datas->description}}</td>
                                <td class="overflow-hidden" style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">{{$datas->body}}</td>
                                <td>{{$datas->name}}</td>
                                <td>{{ $datas->category->title ?? 'No Category' }}</td>
                                <td>{{$datas->post_status}}</td>

                                <td>
                                    @if (Str::startsWith($datas->image, 'http'))
                                        <img src="{{ $datas->image }}" alt="Image" width="50">
                                    @else
                                        <img src="/postimage/{{$datas->image}}" alt="Image" width="50">
                                    @endif
                                </td>

                                <td class="" style="width: 10px;">
                                    @if($datas->video)
                                        @foreach(explode(',', $datas->video) as $videoUrl)
                                            <iframe width="80" height="40" src="{{ $videoUrl }}" frameborder="0" allowfullscreen></iframe>
                                        @endforeach
                                    @else
                                        <p>No Video</p>
                                    @endif
                                </td>

                                <td class="">
                                    <a href="{{route('user_post.edit', $datas->id)}}" class="text-blue-500 ml-10">
                                        <i class="fa-regular fa-pen-to-square text-xl"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $data->links() }}  <!-- This adds pagination links -->
            </div>
        </div>

        {{--End user dashboard --}}

        {{--Start Likes and posts --}}
        <div class="hidden p-4 rounded-lg" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            {{-- @if (Session()->has('success'))
                <div id="alert-1" class="flex items-center w-[80%] mx-10 p-4 mb-4 text-blue-800 rounded-lg bg-sky-200 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        <strong>Success!</strong> {{Session('success')}}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif --}}
            @foreach ($data as $datas)
                @php
                    $date = \Carbon\Carbon::parse($datas->created_at);
                    $isToday = $date->isToday();
                    $formattedDate = $isToday ? 'Today' : $date->format('jS M, Y');
                    $relativeTime = $date->diffForHumans();
                    $uniqueId = 'menu' . $datas->id;
                @endphp

                @if ($datas->image)
                <!-- Post with Image -->
                    <div class="flex">
                        <div class="border mx-6 sm:w-[80%] sm:mx-10 sm:border">
                            <div class="flex flex-col w-[412px] h-[498px] bg-mary gap-x-4 sm:flex-row sm:w-full sm:h-80 sm:px-6 sm:py-8">
                                <div class="w-[349px] sm:w-[70%]  sm:h-full ">
                                    <div class=" h-[48px] flex items-center sm:-mt-4">

                                        <div class="w-[48px] h-[48px] mr-4">
                                            @if (Auth::user())
                                                <img class="w-full h-full sm:w-12 sm:h-12 rounded-full" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="">
                                            @else
                                                <img class="w-full h-full sm:w-12 sm:h-12 rounded-full" src="{{ asset('images/anthony-tran-uM45BGGeync-unsplash.jpg') }}" alt="">
                                            @endif
                                        </div>

                                        <div class="h-[48px]">
                                            <div class="sm:h-[20px] flex items-center font-medium gap-2 text-gray-500">
                                                <p class="text-[10px] font-medium sm:text-base">{{$datas->name}}</p>
                                                <p class="hidden sm:block font-medium mb-4 text-2xl">.</p>
                                                <p class="hidden sm:block sm:text-base">{{$formattedDate}}</p>
                                                <p class="text-[10px] font-medium mb-4 sm:text-2xl">.</p>
                                                <p class="text-[10px] font-medium sm:text-base">{{$relativeTime}}</p>
                                            </div>

                                            <div class="mb-4 mt-3 sm:mt-1">
                                                {{-- <a class="w-[94px] h-[20px] px-4 py-[0.5px] font-medium text-[10px] border border-sky-100 rounded-full sm:py-[.5px] sm:w-[113px] sm:h-[20px] sm:px-4 sm:font-medium sm:text-[12px] bg-sky-200" href="">Tech trends</a> --}}
                                                <a class="w-[94px] h-[20px] px-4 py-[0.5px] font-medium text-[10px] border border-sky-100 rounded-full sm:py-[.5px] sm:w-[113px] sm:h-[20px] sm:px-4 sm:font-medium sm:text-[12px] bg-sky-200" href="">{{$datas->category->title}}</a>
                                            </div>
                                        </div>
                                    </div>
                                {{-- <div class="sm:flex sm:flex-col sm:items-center w-[9%] mt-4">
                                    <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="">
                                </div> --}}

                                    <div class="w-full sm:w-[80%] mt-4 sm:ml-16">
                                        {{-- <div class="flex items-center font-medium gap-2 text-gray-500">
                                            <p>{{$datas->name}}</p>
                                            <p class="font-bold mb-3 text-2xl">.</p>
                                            <p class="">{{$formattedDate}}</p>
                                            <p class="font-bold mb-4 text-2xl">.</p>
                                            <p>{{$relativeTime}}</p>
                                        </div>

                                        <div class="mb-4">
                                            <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                            <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                        </div> --}}

                                        <div class="">
                                            <a href="{{route('read.post', $datas->id)}}">
                                                <h1 class="text-[14px] text-black font-semibold mb-2 sm:text-2xl hover:text-slate-500">{{$datas->title}}</h1>
                                            </a>
                                            <p class="text-[10px] leading-loose font-medium text-gray-500 tracking-wide sm:leading-relaxed sm:text-sm ">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-[381px] h-[274px] bg-slate-50 mt-8 sm:mt-2 sm:w-[30%]">
                                    <img class="w-full h-full rounded-md sm:rounded-md sm:h-52" src="{{$datas->image}}" alt="">
                                    <div class="flex items-center justify-around my-3">
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-up text-[10px] sm:text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-[10px] sm:text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-down text-[10px] sm:text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-[10px] sm:text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-comments text-[10px] sm:text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-[10px] sm:text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-share-nodes text-[10px] sm:text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-[10px] sm:text-xs ml-2">10K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="absolute right-0 sm:relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-dark="true" data-popover-target="{{$uniqueId}}">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>

                        <ul role="menu" data-popover="{{$uniqueId}}" data-popover-placement="bottom"
                            class="absolute right-0 mr-10 min-w-[120px] overflow-auto rounded-md border border-blue-gray-50 bg-white p-3 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none hidden sm:absolute z-10 sm:right-0 sm:mr-0">
                            <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.edit', $datas->id)}}">Update</a>
                            </li>
                            {{-- <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.del', $datas->id)}}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                            </li> --}}
                        </ul>
                    </div>

                    <hr class="w-[438px] my-6 -ml-5 sm:w-[1198px] ">

                @elseif ($datas->video)
                <!-- Post with Video -->
                    <div class="flex">
                        <div class="w-[80%] mx-10">
                            <div class="flex border bg-mary px-6 py-8">
                                <div class="flex flex-col items-center w-[9%] mt-4">
                                    <img class="w-12 h-12 rounded-full" src="{{asset('images/anthony-tran-uM45BGGeync-unsplash.jpg')}}" alt="">
                                </div>

                                <div class="w-[100%] ml-4">
                                    <div class="flex items-center font-medium gap-2 text-gray-500">
                                        <p>{{$datas->name}}</p>
                                        <p class="font-bold mb-4 text-2xl">.</p>
                                        <p class="">{{$formattedDate}}</p>
                                        <p class="font-bold mb-4 text-2xl">.</p>
                                        <p>{{$relativeTime}}</p>
                                    </div>

                                    <div class="mt-2">
                                        <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">{{$datas->category->title}}</a>
                                    </div>

                                    <div class="mt-2.5">
                                        <a href="{{route('read.post', $datas->id)}}">
                                            <h1 class="text-[14px] text-black font-semibold mb-2 sm:text-2xl hover:text-slate-500">{{$datas->title}}</h1>
                                        </a>
                                        <p class="text-sm font-medium text-gray-500 tracking-wide leading-loose mt-3"> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi, dolore quos voluptas nemo nam tempore esse obcaecati. Officiis.</p>
                                    </div>

                                    <div class="w-full mt-4 bg-video pr-4">
                                        <video class="bg-video_content rounded-md" autoplay muted loop>
                                            <source src="{{$datas->video}}" type="video/mp4">
                                        </video>
                                    </div>

                                    <div class="flex items-center justify-end mt-5 gap-x-6 mr-4">
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-dark="true" data-popover-target="{{$uniqueId}}">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>

                        <ul role="menu" data-popover="{{$uniqueId}}" data-popover-placement="bottom"
                            class="absolute right-0 mr-10  min-w-[120px] overflow-auto rounded-md border border-blue-gray-50 bg-white p-3 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none hiddensm:absolute z-10 sm:right-0 sm:mr-0 ">
                            <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.edit', $datas->id)}}">Update</a>
                            </li>
                            <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.del', $datas->id)}}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                            </li>
                        </ul>
                    </div>

                    <hr class="w-[596px] my-6 -ml-5 sm:w-[1198px] ">

                @else
                <!-- Post with Text -->
                    <div class="flex">
                        <div class="w-[80%] mx-10">
                            <div class="flex border bg-white h-80 px-6 py-8">
                                <div class="flex flex-col items-center w-[9%] mt-4">
                                    <img class="w-12 h-12 rounded-full" src="{{asset('images/anthony-tran-uM45BGGeync-unsplash.jpg')}}" alt="">
                                </div>

                                <div class="w-[100%] ml-4">
                                    <div class="flex items-center font-medium gap-2 text-gray-500">
                                        <p>{{$datas->name}}</p>
                                        <p class="font-bold mb-4 text-2xl">.</p>
                                        <p class="">{{$formattedDate}}</p>
                                        <p class="font-bold mb-4 text-2xl">.</p>
                                        <p>{{$relativeTime}}</p>
                                    </div>

                                    <div class="mt-2">
                                        <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">{{$datas->category->title}}</a>
                                    </div>

                                    <div class="mt-2.5">
                                        <a href="{{route('read.post', $datas->id)}}">
                                            <h1 class="text-[14px] text-black font-semibold mb-2 sm:text-2xl hover:text-slate-500">{{$datas->title}}</h1>
                                        </a>
                                        <p class="text-sm font-medium text-gray-500 tracking-wide leading-loose mt-3">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi, dolore quos voluptas nemo nam tempore esse obcaecati. Officiis.</p>
                                    </div>

                                    <div class="flex items-center justify-end mt-5 gap-x-6 mr-6">
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                            <p class="text-slate-500 text-xs ml-2">10K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-dark="true" data-popover-target="{{$uniqueId}}">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>

                        <ul role="menu" data-popover="{{$uniqueId}}" data-popover-placement="bottom"
                            class="absolute right-0 mr-10 min-w-[120px] overflow-auto rounded-md border border-blue-gray-50 bg-white p-3 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none hidden sm:absolute z-10 sm:right-0 sm:mr-0">
                            <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.edit', $datas->id)}}">Update</a>
                            </li>
                            <li role="menuitem"
                                class="active:text-violet-700 hover:text-base font-bold block w-full cursor-pointer select-none rounded-md px-3 pt-[9px] pb-2 text-start leading-tight transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                <a href="{{route('user_post.del', $datas->id)}}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="w-[596px] my-6 -ml-5 sm:w-[1198px] ">
                @endif
            @endforeach

            {{-- <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p> --}}
        </div>
        {{--End Likes and posts --}}

        {{--Start comments --}}
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="flex">
                <div class="w-[80%] mx-10">
                    <div class="flex bg-mary h-80 px-6 py-8 gap-x-4">
                        <div class="flex flex-col items-center w-[9%] mt-4">
                            <img class="w-12 h-12 rounded-full" src="{{asset('images/brooks-leibee-27QcqVqgVg4-unsplash.jpg')}}" alt="">
                        </div>

                        <div class="w-[70%]">
                            <div class="flex items-center font-medium gap-2 text-gray-500">
                                <p class="text-base">Eustass D. kid</p>
                                <p class="font-bold mb-4 text-2xl">.</p>
                                <p class="text-base">6th February, 2024</p>
                                <p class="font-bold mb-4 text-2xl">.</p>
                                <p class="text-base">10 minutes ago</p>
                            </div>

                            <div class="mb-4">
                                <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                            </div>

                            <div class="">
                                <a href="">
                                    <h1 class="text-2xl text-black font-semibold mb-2">Lorem ipsum dolor sit amet consectetur</h1>
                                </a>
                                <p class="text-sm font-medium text-gray-500 tracking-wide leading-relaxed">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                            </div>
                        </div>

                        <div class="w-[30%] bg-slate-50 mt-2">
                            <img class="w-full h-52" src="{{asset('images/news-1172463_640.jpg')}}" alt="">
                            <div class="flex items-center justify-around my-3">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-[86%] ml-24 flex border mt-4 bg-white h-90 px-6 py-8">
                        <div class="flex flex-col items-center w-[9%] mt-4">
                            <img class="w-12 h-12 rounded-full" src="{{asset('images/anthony-tran-uM45BGGeync-unsplash.jpg')}}" alt="">
                        </div>

                        <div class="w-[100%] ml-4">
                            <div class="flex items-center font-medium gap-2 text-gray-500">
                                <p>Eustass D. kid</p>
                                <p class="mb-4 font-bold text-2xl">.</p>
                                <p>6th February, 2024</p>
                                <p class="mb-4 font-bold text-2xl">.</p>
                                <p>10minutes ago</p>
                            </div>

                            <div class="mt-2">
                                <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                            </div>

                            <div class="mt-2.5">
                                <h1 class="text-2xl text-black font-semibold">Lorem ipsum dolor sit amet consectetur</h1>
                                <p class="text-md font-medium text-gray-500 tracking-wide leading-loose">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi, dolore quos voluptas nemo nam tempore esse obcaecati. Officiis.</p>
                            </div>

                            <div class="flex items-center justify-end mt-5 gap-x-6">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                    <p class="text-slate-500 text-xs ml-2">10K</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>

            <hr class="mw-[596px   ] y-10 -ml-5 sm:w-[1198px] ">

            <div class="flex">
                <div class="w-[80%] mx-10">
                    <div>
                        <div class="flex bg-mary h-80 px-6 py-8 gap-x-4">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/brooks-leibee-27QcqVqgVg4-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[70%]">
                                <div class="flex items-center font-medium gap-2 text-gray-500">
                                    <p class="text-base">Eustass D. kid</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">6th February, 2024</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">10 minutes ago</p>
                                </div>

                                <div class="mb-4">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="">
                                    <a href="">
                                        <h1 class="text-2xl text-black font-semibold mb-2">Lorem ipsum dolor sit amet consectetur</h1>
                                    </a>
                                    <p class="text-sm font-medium text-gray-500 tracking-wide leading-relaxed">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                                </div>
                            </div>

                            <div class="w-[30%] bg-slate-50 mt-2">
                                <img class="w-full h-52" src="{{asset('images/news-1172463_640.jpg')}}" alt="">
                                <div class="flex items-center justify-around my-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex w-[88%] ml-20 my-4 bg-mary border h-80 px-6 py-8 gap-x-4">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/jason-goodman-Oalh2MojUuk-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[70%]">
                                <div class="flex items-center font-medium gap-1 text-gray-500">
                                    <p class="text-base">Eustass D. kid</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">6th February, 2024</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">10 minutes ago</p>
                                </div>

                                <div class="mb-4">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="">
                                    <a href="">
                                        <h1 class="text-2xl text-black font-semibold mb-2">Lorem ipsum dolor sit amet consectetur</h1>
                                    </a>
                                    <p class="text-sm font-medium text-gray-500 tracking-wide leading-relaxed">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                                </div>
                            </div>

                            <div class="w-[40%] mt-2">
                                <img class="w-full" src="{{asset('images/news-1172463_640.jpg')}}" alt="">
                                <div class="flex items-center justify-around my-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex border mt-4 bg-white h-90 px-6 py-8">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/anthony-tran-uM45BGGeync-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[100%] ml-4">
                                <div class="flex items-center font-medium gap-2 text-gray-500">
                                    <p>Eustass D. kid</p>
                                    <p class="mb-4 font-bold text-2xl">.</p>
                                    <p>6th February, 2024</p>
                                    <p class="mb-4 font-bold text-2xl">.</p>
                                    <p>10minutes ago</p>
                                </div>

                                <div class="mt-2">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="mt-2.5">
                                    <h1 class="text-2xl text-black font-semibold">Lorem ipsum dolor sit amet consectetur</h1>
                                    <p class="text-md font-medium text-gray-500 tracking-wide leading-loose">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi, dolore quos voluptas nemo nam tempore esse obcaecati. Officiis.</p>
                                </div>

                                <div class="flex items-center justify-end mt-5 gap-x-6">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-r border-lucy h-[590px] absolute top-[1364px] left-[382px]"></div>
                    </div>
                </div>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>

            <hr class="w-[596px] my-8 -ml-5 sm:w-[1198px]">

            <div class="flex">
                <div class="w-[80%] mx-10">
                    <div>
                        <div class="flex bg-mary h-80 px-6 py-8 gap-x-4">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/brooks-leibee-27QcqVqgVg4-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[70%]">
                                <div class="flex items-center font-medium gap-2 text-gray-500">
                                    <p class="text-base">Eustass D. kid</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">6th February, 2024</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">10 minutes ago</p>
                                </div>

                                <div class="mb-4">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="">
                                    <a href="">
                                        <h1 class="text-2xl text-black font-semibold mb-2">Lorem ipsum dolor sit amet consectetur</h1>
                                    </a>
                                    <p class="text-sm font-medium text-gray-500 tracking-wide leading-relaxed">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                                </div>
                            </div>

                            <div class="w-[30%] bg-slate-50 mt-2">
                                <img class="w-full h-52" src="{{asset('images/news-1172463_640.jpg')}}" alt="">
                                <div class="flex items-center justify-around my-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex w-[88%] ml-20 my-4 bg-mary border h-80 px-6 py-8 gap-x-4">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/jason-goodman-Oalh2MojUuk-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[70%]">
                                <div class="flex items-center font-medium gap-1 text-gray-500">
                                    <p class="text-base">Eustass D. kid</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">6th February, 2024</p>
                                    <p class="font-bold mb-4 text-2xl">.</p>
                                    <p class="text-base">10 minutes ago</p>
                                </div>

                                <div class="mb-4">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="">
                                    <a href="">
                                        <h1 class="text-2xl text-black font-semibold mb-2">Lorem ipsum dolor sit amet consectetur</h1>
                                    </a>
                                    <p class="text-sm font-medium text-gray-500 tracking-wide leading-relaxed">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi Lorem ipsum dolor quas ducimus hgud</p>
                                </div>
                            </div>

                            <div class="w-[40%] mt-2">
                                <img class="w-full" src="{{asset('images/news-1172463_640.jpg')}}" alt="">
                                <div class="flex items-center justify-around my-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex border mt-4 bg-white h-90 px-6 py-8">
                            <div class="flex flex-col items-center w-[9%] mt-4">
                                <img class="w-12 h-12 rounded-full" src="{{asset('images/anthony-tran-uM45BGGeync-unsplash.jpg')}}" alt="">
                            </div>

                            <div class="w-[100%] ml-4">
                                <div class="flex items-center font-medium gap-2 text-gray-500">
                                    <p>Eustass D. kid</p>
                                    <p class="mb-4 font-bold text-2xl">.</p>
                                    <p>6th February, 2024</p>
                                    <p class="mb-4 font-bold text-2xl">.</p>
                                    <p>10minutes ago</p>
                                </div>

                                <div class="mt-2">
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Tech trends</a>
                                    <a class="border rounded-full py-1 px-4 font-medium text-sm bg-sky-200" href="">Entertainment</a>
                                </div>

                                <div class="mt-2.5">
                                    <h1 class="text-2xl text-black font-semibold">Lorem ipsum dolor sit amet consectetur</h1>
                                    <p class="text-md font-medium text-gray-500 tracking-wide leading-loose">Lorem ipsum dolor Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi totam consectetur est soluta. Odio quis accusamus libero earum quas ducimus sequi, dolore quos voluptas nemo nam tempore esse obcaecati. Officiis.</p>
                                </div>

                                <div class="flex items-center justify-end mt-5 gap-x-6">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-down text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-comments text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-share-nodes text-xs text-slate-500"></i>
                                        <p class="text-slate-500 text-xs ml-2">10K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-l border-lucy h-[590px] absolute top-[2420px] left-[382px]"></div>
                    </div>
                </div>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>
        </div>
        {{--End comments --}}

        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
    </div>
</section>
{{-- End profilebar --}}
