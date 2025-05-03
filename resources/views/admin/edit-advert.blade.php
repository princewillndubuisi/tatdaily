<!DOCTYPE html>
<html>
  <head>
    <base href="/public">

    @include('admin.include.css')
  </head>
  <body>
    @include('admin.include.header')

    <div class="d-flex align-items-stretch">
      @include('admin.include.sidebar')

      <div class="page-content w-[2000px]">
        @if (Session()->has('success'))
          <div class="bg-yellow-100 border-t border-b border-yellow-500 text-yellow-700 px-4 py-3 mt-1 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ Session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" onclick="this.parentElement.style.display='none';">
              <span class="text-2xl font-semibold text-yellow-700" aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Update Advert</h2>
          </div>
        </div>

        <div class="col-lg-10 mx-auto">
          <div class="block">
            <div class="block-body">
              <form method="POST" action="{{route('advert.update', $advert->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex justify-between my-4">
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Advert Title</label>
                    <input type="text" name="title" placeholder="Title" value="{{$advert->title}}" class="form-control bg-dark rounded">
                  </div>

                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Advert Duration (Seconds)</label>
                    <input type="number" name="display_duration" value="{{$advert->display_duration}}" placeholder="Duration" class="form-control bg-dark rounded">
                  </div>
                </div>

                <div class="flex justify-between">
                  <!-- Video Upload -->
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Video</label>
                    <input type="file" name="video_path" accept="video/*" class="form-control" id="videoUpload">

                    <!-- Show old video if exists -->
                    @if ($advert->video_path)
                      <video id="videoPreview" class="mt-2 w-full h-48" autoplay loop muted controls>
                        <source src="{{ asset('storage/' . $advert->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                      </video>
                    @else
                      <video id="videoPreview" class="mt-2 w-full h-48 hidden" autoplay loop muted controls></video>
                    @endif
                  </div>

                  <!-- Image Upload -->
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Image</label>
                    <input type="file" name="image_path" accept="image/*" class="form-control" id="imageUpload">

                    <!-- Show old image if exists -->
                    @if ($advert->image_path)
                      <img id="imagePreview" class="mt-2 w-full h-48 object-cover rounded" src="{{ asset('storage/' . $advert->image_path) }}" alt="Advert Image">
                    @else
                      <img id="imagePreview" class="mt-2 w-full h-48 hidden object-cover rounded" alt="Advert Image">
                    @endif
                  </div>
                </div>

                <div class="form-group col-6">
                  <input type="submit" value="Update Advert" class="btn btn-primary col-5">
                </div>
              </form>
            </div>
          </div>
        </div>

        @include('admin.include.footer')
      </div>
    </div>

    @include('admin.include.js')

    <!-- JavaScript for Thumbnails -->
    <script>
      document.getElementById('videoUpload').addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (file) {
          let videoPreview = document.getElementById('videoPreview');
          videoPreview.src = URL.createObjectURL(file);
          videoPreview.classList.remove('hidden');
        }
      });

      document.getElementById('imageUpload').addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (file) {
          let imagePreview = document.getElementById('imagePreview');
          imagePreview.src = URL.createObjectURL(file);
          imagePreview.classList.remove('hidden');
        }
      });
    </script>

  </body>
</html>
