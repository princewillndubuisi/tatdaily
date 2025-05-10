@extends('layout.app')

@section('title')
    Category | {{ $category->title ?? 'Posts' }}
@endsection

@section('content')
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .post-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
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

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-color: transparent;
        }

        .pagination .page-link {
            color: #3b82f6;
            border: 1px solid #e2e8f0;
            margin: 0 4px;
            border-radius: 8px !important;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #f1f5f9;
        }

        .media-placeholder {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(59, 130, 246, 0.3) 50%, transparent 100%);
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 pt-52 sm:px-6 lg:px-8 sm:py-12">
        <!-- Category Header -->
        <div class="text-center mb-16 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <span class="gradient-text">{{ $category->title ?? 'All Posts' }}</span>
            </h1>
            <p class="text-xl sm:text-lg text-gray-600 max-w-2xl mx-auto">
                Discover the latest stories, ideas and knowledge in {{$category->title}}
            </p>
            <div class="mt-6 flex justify-center">
                <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 gap-8 md:gap-10">
            @foreach ($post as $posts)
                @php
                    $date = \Carbon\Carbon::parse($posts->created_at);
                    $isToday = $date->isToday();
                    $formattedDate = $isToday ? 'Today' : $date->format('jS M, Y');
                    $relativeTime = $date->diffForHumans();
                @endphp

                <div class="post-card rounded-2xl overflow-hidden border border-gray-100 hover:border-transparent"
                    style="animation: fadeIn 0.6s ease-out {{ $loop->index * 0.1 }}s both;">

                    <!-- Media + Content Container -->
                    <div class="flex flex-col md:flex-row">
                        <!-- Media Section -->
                        <div class="w-full md:w-2/5 h-64 relative overflow-hidden">
                            @if ($posts->image)
                                <img src="{{ $posts->image }}" alt="{{ $posts->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            @elseif ($posts->video)
                                <video class="w-full h-full object-cover" autoplay muted loop>
                                    <source src="{{ $posts->video }}" type="video/mp4">
                                </video>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            @else
                                <div class="media-placeholder w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col justify-between">
                            <!-- Header Info -->
                            <div class="mb-4">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ Auth::user() ? asset('storage/' . Auth::user()->photo) : asset('images/user.jpg') }}"
                                            class="w-12 h-12 sm:w-10 sm:h-10 rounded-full border-2 border-white shadow-sm object-cover" alt="User">
                                        <div>
                                            <p class="text-lg sm:text-sm font-medium text-gray-900">{{ $posts->name }}</p>
                                            <p class="text-md sm:text-xs text-gray-500">{{ $formattedDate }} • {{ $relativeTime }}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <span class="px-4 py-1 rounded-full text-md sm:text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $posts->category->title }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Title + Description -->
                                <a href="{{ route('read.post', $posts->id) }}" class="block group">
                                    <h3 class="text-3xl font-bold text-gray-900 mb-3 title-underline inline-block">
                                        {{ \Illuminate\Support\Str::limit($posts->title, 80) }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 leading-relaxed text-2xl sm:text-lg">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($posts->description), 140) }}
                                    </p>
                                </a>
                            </div>

                            <!-- Footer Actions -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex space-x-4 text-sm text-gray-500">
                                    <span class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                        <livewire:like-button :key="$posts->id" :posts="$posts" />
                                    </span>
                                    <span class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                        <i class="far fa-comment"></i>
                                        <span>{{ $posts->comments()->count() }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1 hover:text-red-500 transition-colors">
                                        <i class="far fa-thumbs-down"></i>
                                        <span>10K</span>
                                    </span>
                                </div>
                                <div class="">
                                    <button onclick="sharePost('{{ $posts->id }}', '{{ $posts->title }}', '{{ asset('storage/' . $posts->image) }}')"
                                    class="p-2 rounded-full hover:bg-gray-100 transition-colors text-gray-500 hover:text-blue-500">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$loop->last)
                    <div class="divider my-2"></div>
                @endif
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $post->onEachSide(1)->links() }}
        </div>
    </div>


    <script>
        // Simple share function
        function sharePost(postId, title, image) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: 'Check out this interesting post!',
                    url: window.location.origin + '/read/post/' + postId,
                })
                .catch(error => console.log('Error sharing:', error));
            } else {
                // Fallback for browsers that don't support Web Share API
                const shareUrl = window.location.origin + '/read/post/' + postId;
                alert(`Share this post: ${title}\n${shareUrl}`);
            }
        }
    </script>
@endsection
