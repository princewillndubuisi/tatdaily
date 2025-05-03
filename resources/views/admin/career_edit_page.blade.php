<!DOCTYPE html>
<html>
  <head>
    <base href="/public">

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
                    <h2 class="h5 no-margin-bottom">Add Career</h2>
                </div>
            </div>

            <div class="col-lg-10 mx-auto">
                <div class="block">
                    <div class="block-body">
                        <form method="POST" action="{{route('career.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{$career->id}}">
                            <div class="flex justify-between my-4">
                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Career Title</label>
                                    <input type="text" name="title" value="{{$career->title}}" placeholder="Title" class="form-control bg-dark rounded">
                                </div>

                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Company Name</label>
                                    <input type="text" name="company" value="{{$career->company}}" placeholder="Name" class="form-control bg-dark rounded">
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Company Logo</label>
                                    @if($career->logo)
                                        <img style="width: 120px" src="{{ asset('storage/' . $career->logo) }}" class="mb-3" alt="">
                                    @endif
                                    <input type="file" name="logo" value="{{$career->logo}}" class="form-control">
                                </div>
                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Location <span>(e.g. Remote, United States)</span></label>
                                    <input type="text" name="location" value="{{$career->location}}"  placeholder="Location" class="form-control bg-dark rounded">
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Apply Link</label>
                                    <input type="text" name="apply_link" value="{{$career->apply_link}}"  class="form-control bg-dark rounded">
                                </div>
                                <div class="form-group col-5">
                                    <label class="form-control-label text-white">Tags (Seperate by coma)</label>
                                    <input type="text" name="tags" value="{{ $career->tags->pluck('name')->implode(', ') }}" class="form-control bg-dark rounded">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="form-control-label text-white">Content</label>
                                <textarea class="form-control rounded" name="content"  id=""  rows="3">{{$career->content}}</textarea>
                            </div>

                            <div class="form-group col-5">
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
  </body>
</html>
