<!DOCTYPE html>
<html>
  <head>
    <base href="/public">

    @include('admin.include.css')
  </head>
  <body>
    <style>
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
    </style>

    @include('admin.include.header')

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.include.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        @if (Session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
                <strong>Success!</strong> {{Session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Body-->
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Update Post</h2>
            </div>
        </div>

        <div class="col-lg-10 mx-auto">
            <div class="block">
                <div class="block-body">
                    <form method="POST" action="{{route('update.post', $post->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="flex justify-between">
                            <div class="form-group col-5">
                                <label class="form-control-label text-white">Post Title</label>
                                <input type="text" name="title" value="{{$post->title}}" placeholder="Title" class="form-control bg-dark rounded text-white">
                                @error('title')
                                    <span class="alert alert-danger mt-2">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-5">
                                <label class="form-control-label text-white">Category</label>
                                <select class="form-select form-control bg-dark rounded text-white" name="category_id" aria-label="Default select example">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="alert alert-danger mt-2">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-control-label text-white">Post Description</label>
                            <textarea class="form-control bg-dark rounded text-white" name="description"  rows="2">{{$post->description}}</textarea>
                            @error('description')
                                <span class="alert alert-danger mt-2">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label class="form-control-label text-white">Post Body</label>
                            <textarea class="form-control bg-dark rounded" name="body" id="editor">{{$post->body}}</textarea>
                            @error('body')
                                <span class="alert alert-danger mt-2">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-5">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Body end-->

        <!-- Footer-->
        @include('admin.include.footer')
        <!-- Footer end-->
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.include.js')

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
