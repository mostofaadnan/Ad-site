<?php $HeaderMenus = \App\Models\menu::where('menu_type', 1)->get();?>
<?php $FooterMenus = \App\Models\menu::where('menu_type', 2)->get();?>
<?php $adBanners = \App\Models\addBaner::where('status', 1)->get();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('image/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('image/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('image/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('image/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('image/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('image/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('image/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('image/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('image/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('image/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('image/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('image/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('image/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('image/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- font awosome cdn -->
    <script src="https://kit.fontawesome.com/e6a5841b3b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!--     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="{{asset('assets/FrontEnd/css/style.css')}}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <title>{{ config('company.company_name') }}</title>
</head>

<body>
    <!-- navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!--     <a href="{{ route('fronthome') }}" class="brand"><b>{{ config('company.company_name') }}</b></a> -->
            <a href="{{ route('fronthome') }}" class="brand"><img
                    src="{{ asset('image/logo/'.config('company.main_logo')) }}"
                    class="img-responsive center-block d-block mx-auto" alt="" width="200"></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <a href="{{ route('adpost.locationSet') }}" class="btn btn-info post-ad-btn">Post Ad</a>
                <!--        <div class="navbar-nav">
                    <a href="{{ route('fronthome') }}" class="nav-item nav-link">Home</a>
                    @foreach($HeaderMenus as $menu)
                    <a href="{{ route('front.page',$menu->page_id) }}"
                        class="nav-item nav-link">{{ $menu->menu_title }}</a>
                    @endforeach
                </div> -->
                <div class="navbar-nav ml-auto action-buttons">

                    <div class="navbar-nav ms-lg-4">
                        <a class="nav-item nav-link" href="{{ route('user.dashboard') }}" class="nav-link mr-4"><b
                                style="font-size:16px; color:#04787d;">My Account</b></a>
                    </div>
                </div>
        </nav>
    </header>

    <div class="main">
        @if(config('company.ad_banner')==1)
        <div class="row">
            <div class="col-sm-10 col-md-10">
                @yield('content')
            </div>
            <div class="col-sm-2 col-md-2">
                @include('FrontEnd.layouts.adBanner')
            </div>
        </div>
        @else
        @yield('content')
        @endif
    </div>

    <footer id="footer">
        <div class="container text-center">
            <ul class="list-inline">
                @foreach($FooterMenus as $menu)
                <li class="list-inline-item"><a
                        href="{{ route('front.page',$menu->page_id) }}">{{ $menu->menu_title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="text-center reserved">
            <p>{{ config('company.copy_rights') }}</p>
        </div>
    </footer>



    <!-- bootstrap js cdn -->

    <!--         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
      -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 200
    });
    </script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
</body>

</html>
