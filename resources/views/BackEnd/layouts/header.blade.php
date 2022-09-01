<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu-left d-none d-lg-block">
                <ul class="nav">
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('fronthome') }}" target="_blank"><i class='bx bx-home'></i></a>
                    </li>
                    <!--    <li class="nav-item">
                        <a class="nav-link" href=""><i class='bx bx-envelope'></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class='bx bx-message'></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class='bx bx-calendar'></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class='bx bx-check-square'></i></a>
                    </li> -->
                </ul>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                  
                    <li class="nav-item dropdown dropdown-large">
                        <?php
$postnotification = auth()->user()->Notifications
    ->where('type', 'App\Notifications\PostNotification')
    ->all();

$postnotificationunread = auth()->user()->unreadNotifications
    ->where('type', 'App\Notifications\PostNotification')
    ->all();
?>

                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">{{ count($postnotificationunread) }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    <p class="msg-header-clear ms-auto">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @foreach($postnotification as $notify)

                                @if($notify->read_at==null)
                                <a class="dropdown-item message" data-id="{{ $notify->id }}"
                                    style="background-color:#ccc;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="msg-info">{{ $notify->data['message'] }} </p>
                                        </div>
                                    </div>
                                </a>
                                @else
                                <a class="dropdown-item message" data-id="{{ $notify->id }}">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="msg-info">{{ $notify->data['message'] }} </p>
                                        </div>
                                    </div>
                                </a>
                                @endif
                                @endforeach
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Notifications</div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">0</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-clear ms-auto">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Messages</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown border-light-2">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('image/user/'.Auth::user()->image) }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.reset.password') }}"><i
                                class="bx bx-cog"></i><span>Password Change</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.home') }}"><i
                                class='bx bx-home-circle'></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<script>
$(document).on('click', ".message", function() {
    var id = $(this).data("id")
    url = "{{ url('Admin/Notifications/markAsReadmessage')}}" + '/' + id,
        window.location = url;
});
</script>