<div>
    @auth
        <div class="w-full my-12 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                {{-- <label for="comment" class="sr-only">Your comment</label> --}}
                <textarea wire:model.defer="comment" id="" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required ></textarea>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                <button wire:click='postComment' type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Post comment
                </button>
            </div>
        </div>
        @else
        <div class="border-2 border-gray-500 sm:border sm:border-tega  flex items-center justify-center bg-white w-full h-20 mt-12 rounded">
            <a wire:navigate href="{{route('login')}}" class="text-gray-500 text-[10px] font-semibold sm:text-princess sm:text-xl sm:font-semibold">Log in/Sign up to comment on or like this post</a>
        </div>
    @endauth

    <div class="mt-8 border border-tega rounded bg-white">
        @forelse ($comments as $comment)
            <div class="my-6 w-[90%] mx-auto">
                <div class="flex items-center gap-4 font-medium text-xl text-black ">
                    <p class="font-bold">Written by {{$comment->user->name}}</p>
                    <p class="font-bold mb-2.5 text-2xl">.</p>
                    <p class="font-bold">{{$comment->created_at->diffForHumans()}}</p>
                </div>
                <div class="font-medium text-white mt-2">
                    <a class="mr-4 border border-orange-100 rounded-full py-2 px-8 font-medium text-sm bg-red-500" href="">
                        Level 2
                    </a>
                    <span class="mr-4 text-4xl text-black">.</span>
                    <a href="" class="text-blue-400 text-lg">Follow</a>
                </div>
                <p class="mt-8 text-xl text-princess leading-loose font-semibold">
                    {{$comment->comment}}
                </p>
            </div>
            <hr>
        @empty
            <div class="border border-tega flex items-center justify-center bg-white w-full h-20 mt-12 rounded">
                <p>No Comments posted</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{$comments->links()}}
    </div>
</div>
