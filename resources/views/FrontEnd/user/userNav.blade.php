<style>
.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}
</style>



<section class="header-section">
    <div class="container">
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="header-nav">
                    <ul class="list-unstyled components">
                        <li>
                            <i class="fa-solid fa-user"></i>
                            <a href="{{ route('user.dashboard') }}">My Account</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <i class="fa-solid fa-list-check"></i>
                            <a href="{{ route('user.ManagePost') }}">Manage Posts</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <i class="fa-solid fa-credit-card"></i>
                            <a href="{{ route('user.reloadBalance') }}">Reload Balance</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <i class="fa-solid fa-square-pen"></i>
                            <a href="{{ route('adpost.locationSet') }}"> Post Ad</a>

                        </li>
                        <li class="divider"></li>
                        <li>
                            <i class="fa-solid fa-square-pen"></i>
                            <a href="{{ route('user.Setting') }}">User Setting</a>

                        </li>
                        <li class="divider"></li>
                        <li>
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                               Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>