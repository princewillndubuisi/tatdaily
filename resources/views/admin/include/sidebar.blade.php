<nav id="sidebar" class="col-2">
    <!-- Sidebar Header-->
    <div class="sidebar-header -mt-8 -ml-10 d-flex align-items-center ">
        <x-app-layout>
        </x-app-layout>
    </div>
    <!-- Sidebar Navidation Menus-->
    <ul class="list-unstyled -mt-7">
            <li class="{{ Request::is('dashboard_page') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('dashboard.page')}}"> <i class="icon-logout"></i>Dashboard </a></li>
            <li class="{{ Request::is('show_post') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('show.advert')}}"> <i class="fa fa-bar-chart"></i>Adverts </a></li>
            <li class="{{ Request::is('show_post') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('show.post')}}"> <i class="fa fa-bar-chart"></i>Post </a></li>
            <li class="{{ Request::is('show_category') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('show.category')}}"> <i class="icon-home"></i>Category </a></li>
            <li class="{{ Request::is('show_career') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('show.career')}}"> <i class="icon-home"></i>Career </a></li>
            <li class="{{ Request::is('applied_career') ? ' bg-secondary text-white' : 'bg-dark bg-gradient' }}"><a href="{{route('career.applied')}}"> <i class="icon-home"></i>Job </a></li>
    </ul>
    {{-- <span class="heading">Extras</span> --}}
    {{-- <ul class="list-unstyled">
      <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul> --}}
</nav>
