<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <!--   <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div> -->
        <div>
            <h4 class="logo-text">{{ config('company.company_name') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.home') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i></div>
                <div class="menu-title">Setup</div>
            </a>
            <ul>
                <li><a href="{{route('countrys')}}"><i class="bx bx-right-arrow-alt"></i>Country</a></li>
                <li><a href="{{route('states')}}"><i class="bx bx-right-arrow-alt"></i>State</a></li>
                <li><a href="{{route('citys')}}"><i class="bx bx-right-arrow-alt"></i>City</a></li>
                <li><a href="{{route('categories')}}"><i class="bx bx-right-arrow-alt"></i>Category</a></li>
                <li><a href="{{Route('subcategories')}}"><i class="bx bx-right-arrow-alt"></i>Sub-Category</a></li>
                <li><a href="{{Route('features')}}"><i class="bx bx-right-arrow-alt"></i>Feature Type</a></li>
                <li><a href="{{Route('extends')}}"><i class="bx bx-right-arrow-alt"></i>Extend Type</a></li>
                <li><a href="{{Route('reportoptions')}}"><i class="bx bx-right-arrow-alt"></i>Report Option</a></li>
            </ul>
        </li>
        <!--     <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i></div>
                <div class="menu-title">Package</div>
            </a>
            <ul>
                <li><a href="{{route('packages')}}"><i class="bx bx-right-arrow-alt"></i>Package List</a></li>
            </ul>
        </li> -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-video-recording'></i></div>
                <div class="menu-title">Ad Post</div>
            </a>
            <ul>
                <li><a href="{{route('PostManages')}}"><i class="bx bx-right-arrow-alt"></i>Ad Post List</a></li>
                <li><a href="{{route('AdReports')}}"><i class="bx bx-right-arrow-alt"></i>Report Post</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user-pin'></i></div>
                <div class="menu-title">User</div>
            </a>
            <ul>
                <li><a href="{{route('userlist')}}"><i class="bx bx-right-arrow-alt"></i>User</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i></div>
                <div class="menu-title">Site Setting</div>
            </a>
            <ul>
            <li><a href="{{route('general.show')}}"><i class="bx bx-right-arrow-alt"></i>General Setting</a></li>
                <li><a href="{{route('pages')}}"><i class="bx bx-right-arrow-alt"></i>Page List</a></li>
                <li><a href="{{route('page.create')}}"><i class="bx bx-right-arrow-alt"></i>New Page</a></li>
                <li><a href="{{route('menus')}}"><i class="bx bx-right-arrow-alt"></i>Menu List</a></li>
                <li><a href="{{route('posts')}}"><i class="bx bx-right-arrow-alt"></i>Post List</a></li>
                <li><a href="{{route('post.create')}}"><i class="bx bx-right-arrow-alt"></i>New Post</a></li>
                <li><a href="{{route('adbanners')}}"><i class="bx bx-right-arrow-alt"></i>Ad Banner</a></li>
                <li><a href="{{route('api.show')}}"><i class="bx bx-right-arrow-alt"></i>Api</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-spa'></i></div>
                <div class="menu-title">User Balance History</div>
            </a>
            <ul>
                <li><a href="{{route('userbalancesHistory')}}"><i class="bx bx-right-arrow-alt"></i>User Balance
                        List</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user-pin'></i></div>
                <div class="menu-title">Admin User</div>
            </a>
            <ul>
                <li><a href="{{route('admins')}}"><i class="bx bx-right-arrow-alt"></i>Admin User List</a></li>
                <li><a href="{{route('admin.create')}}"><i class="bx bx-right-arrow-alt"></i>New User</a></li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
