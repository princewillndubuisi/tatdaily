<!DOCTYPE html>
<html>
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @include('admin.include.css')
  </head>
  <body>

    @include('admin.include.header')

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.include.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content w-[1300px] overflow-hidden">
        <!-- Body-->
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">All Posts</h2>
            </div>
        </div>

        <div class="col-lg-12 mx-auto">
            <div class="mb-4 flex align-items-center justify-content-between">
                @if (Session()->has('success'))
                    <div class="col-lg-8 alert alert-warning alert-dismissible fade show mt-2" role="alert">
                        <strong>Success!</strong> {{Session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <a class="btn btn-info hover:text-black" href="{{route('post.page')}}">Add Post</a>
            </div>
            <div class="block">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-black">
                            <tr>
                                <th>#</th>
                                <th class="h6">Title</th>
                                <th class="h6">Description</th>
                                <th class="h6">Body</th>
                                <th class="h6">Post by</th>
                                <th class="h6">Category</th>
                                <th class="h6">Status</th>
                                <th class="h6">Type</th>
                                <th class="h6">Image</th>
                                <th class="h6">Video</th>
                                <th class="h6">Delete</th>
                                <th class="h6">Edit</th>
                                <th class="h6">Stat Accept</th>
                                <th class="h6">Stat Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{$post->id}}</th>
                                    <td>{{$post->title}}</td>
                                    <td class="overflow-hidden" style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">{{$post->description}}</td>
                                    <td class="overflow-hidden" style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">{{$post->body}}</td>
                                    <td>{{$post->name}}</td>
                                    <td>{{ $post->category->title ?? 'No Category' }}</td>
                                    <td>{{$post->post_status}}</td>
                                    <td>{{$post->usertype}}</td>

                                    <td>
                                        @if (Str::startsWith($post->image, 'http'))
                                            <img src="{{ $post->image }}" alt="Image" width="100">
                                        @else
                                            <p>No Image</p>
                                        @endif
                                    </td>

                                    <td class="" style="width: 10px;">
                                        @if($post->video)
                                            @foreach(explode(',', $post->video) as $videoUrl)
                                                @php
                                                    $videoUrl = trim($videoUrl);
                                                    if (str_contains($videoUrl, 'youtu.be')) {
                                                        // Convert short URL to embed
                                                        $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                    } elseif (str_contains($videoUrl, 'youtube.com/watch')) {
                                                        // Convert watch URL to embed
                                                        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                                                        $embedUrl = 'https://www.youtube.com/embed/' . ($query['v'] ?? '');
                                                    } else {
                                                        $embedUrl = $videoUrl;
                                                    }
                                                @endphp
                                                <iframe width="100" height="50" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                            @endforeach
                                        @else
                                            <p>No Video</p>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{route('delete.post', $post->id)}}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                                    </td>
                                    <td>
                                        <a href="{{route('edit.page', $post->id)}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" href="{{route('accept.post', $post->id)}}">Accept</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-secondary" href="{{route('reject.post', $post->id)}}">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination text-center w-full font-medium mt-4 flex justify-center">
                    {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
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
        function confirmation(ev) {
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            console.log(urlToRedirect);

            swal({
                title : "Are you sure to delete?",
                text : "You won't be able to revert this delete",
                icon : "warning",
                buttons : {
                    cancel : "Cancel",
                    confirmation : "Yes"
                },
                dangerMode : "true",
            })

            .then((willCancel)=>
                {
                    if(willCancel) {
                        window.location.href = urlToRedirect;
                    }
                }
            );
        }
    </script>
  </body>
</html>
