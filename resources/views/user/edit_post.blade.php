@extends('layout.app')

@section('title')
    Edit Post
@endsection

@section('content')
<div class="sm:w-[900px] sm:mx-auto">
    <form class="" action="{{route('user_post.update', ['id' => $data->id])}}" method="POST">
        @csrf

        <div class="sm:w-full sm:flex sm:items-center sm:justify-between sm:mb-4">
            <div class="mb-5 sm:w-[400px]">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="" name="title" value="{{$data->title}}" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title" required />
                @error('title')
                    <span class="alert alert-danger">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-5 sm:w-[400px]">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select name="category_id" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ $data->category_id == $category->id ? 'selected' : '' }}>
                            {{$category->title}}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="alert alert-danger">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="sm:w-full sm:mb-4">
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea name="description" value="{{$data->description}}"  id="" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                {{$data->description}}
            </textarea>
            @error('description')
                <span class="alert alert-danger">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
        </div>

        <div class="sm:w-full sm:mb-4">
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea name="body" value=""  id="editor" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                {{$data->body}}
            </textarea>
            @error('body')
                <span class="alert alert-danger">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</div>
@endsection
