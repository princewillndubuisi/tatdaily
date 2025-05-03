<!DOCTYPE html>
<html>
  <head>
    @include('admin.include.css')
  </head>
  <body>
    @include('admin.include.header')

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.include.sidebar')
      <!-- Sidebar Navigation end-->

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

        <!-- Body-->
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Add Advert</h2>
          </div>
        </div>

        <div class="col-lg-10 mx-auto">
          <div class="block">
            <div class="block-body">
              <form method="POST" action="{{ route( 'advert.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex justify-between my-4">
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Advert Title</label>
                    <input type="text" name="title" placeholder="Title" class="form-control bg-dark rounded">
                  </div>

                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Advert Duration (Seconds)</label>
                    <input type="number" name="display_duration" placeholder="Duration" class="form-control bg-dark rounded">
                  </div>
                </div>

                <div class="flex justify-between">
                  <!-- Video Upload -->
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Video</label>
                    <input type="file" name="video_path" accept="video/*" class="form-control dark:border-gray-600 dark:placeholder-gray-400" id="videoUpload">
                    <video id="videoPreview" class="mt-2 w-full h-48 hidden" autoplay loop muted controls>
                      Your browser does not support the video tag.
                    </video>
                  </div>

                  <!-- Image Upload -->
                  <div class="form-group col-5">
                    <label class="form-control-label text-white">Image</label>
                    <input type="file" name="image_path" accept="image/*" class="form-control dark:border-gray-600 dark:placeholder-gray-400" id="imageUpload">
                    <img id="imagePreview" class="mt-2 w-full h-48 hidden object-cover rounded" alt="Advert Image">
                  </div>
                </div>

                <div class="form-group col-6">
                  <input type="submit" value="Submit" class="btn btn-primary col-5">
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
