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

    <div class="page-content w-[2000px]">
        <!-- Body-->
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">All Adverts</h2>
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
                <a class="btn btn-danger" href="{{route('add.advert')}}">Add Advert</a>
            </div>
            <div class="block">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-black">
                            <tr>
                                <th>#</th>
                                <th class="h6">Title</th>
                                <th class="h6">Video</th>
                                <th class="h6">Image</th>
                                <th class="h6">Duration</th>
                                <th class="h6">Is_active</th>
                                <th class="h6">Edit</th>
                                <th class="h6">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adverts as $advert)
                                <tr>
                                    <th scope="row">{{$advert->id}}</th>
                                    <td>{{$advert->title}}</td>
                                    <td>
                                        @if($advert->video_path)
                                            <video width="100" autoplay loop muted controls>
                                                <source src="{{ asset('storage/' . $advert->video_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            No Video
                                        @endif
                                    </td>
                                    <td>
                                        @if($advert->image_path)
                                            <img src="{{asset('storage/' . $advert->image_path)}}" width="70" alt="">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{$advert->display_duration}}</td>
                                    <td>{{$advert->is_active}}</td>
                                    <td>
                                        <a href="{{route('advert.edit', ['id' => $advert->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{route('advert.delete', ['id' => $advert->id])}}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
