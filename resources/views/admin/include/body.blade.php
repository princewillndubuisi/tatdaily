<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard</h2>
    </div>
</div>

{{-- All Users --}}
<section class="no-padding-top no-padding-bottom ">
<div class="container-fluid">
    <div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
        <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
            <div class="icon"><i class="icon-user-1"></i></div><strong>All Users</strong>
            </div>
            <div class="number dashtext-1">{{$users}}</div>
        </div>
        <div class="progress progress-template">
            <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
        </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
        <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
            <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Blogs</strong>
            </div>
            <div class="number dashtext-4">{{$blogs}}</div>
        </div>
        <div class="progress progress-template">
            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>

{{-- All Blogs --}}
<section class="no-padding-bottom">
<div class="container-fluid">
    <div class="row">
    <div class="col-lg-4">
        <div class="bar-chart block no-margin-bottom">
        <canvas id="barChartExample1"></canvas>
        </div>
        <div class="bar-chart block">
        <canvas id="barChartExample2"></canvas>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="line-cahrt block">
        <canvas id="lineCahrt"></canvas>
        </div>
    </div>
    </div>
</div>
</section>

<section class="no-padding-top no-padding-bottom ">
    <div class="block">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="bg-black">
                    <tr>
                        <th>#</th>
                        <th class="h6">Name</th>
                        <th class="h6">Email</th>
                        <th class="h6">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $users)
                        <tr>
                            <th scope="row">{{$users->id}}</th>
                            <td>{{$users->name}}</td>
                            <td>{{$users->email}}</td>
                            <td>
                                <a href="" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
