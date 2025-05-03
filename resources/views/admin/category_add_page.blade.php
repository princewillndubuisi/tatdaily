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
            <!-- Body-->
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Add Category</h2>
                </div>
            </div>

            <div class="col-lg-10 mx-auto">
                <div class="block">
                    <div class="block-body">
                        <form method="POST" action="{{route('add.category')}}">
                            @csrf

                            <div class="form-group">
                                <label class="form-control-label text-white">Category Title</label>
                                <input type="text" name="title" placeholder="Title" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
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
  </body>
</html>
