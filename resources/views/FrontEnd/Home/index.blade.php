@extends('FrontEnd.layouts.master')
@section('content')
<!-- main body -->
<main>
    <!-- header-section -->
    <section id="header-section">
        <div class="header-info">
            <div class="container">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-left">
                            <a href="{{ route('fronthome') }}"><img
                                    src="{{ asset('image/logo/'.config('company.main_logo')) }}"
                                    class="img-responsive d-block mx-auto"
                                    alt="{{ config('company.company_name') }}"></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <ul class="list-inline ml-auto" style="border:none !important;">
                                <li class="list-inline-item pt-0 pr-1 pb-0 pl-0"> <a
                                        href="{{ route('adpost.locationSet') }}" class="btn btn-info post-ad-btn">Post
                                        Ad</a></li>
                                @guest
                                @if (Route::has('login'))
                                <li class="list-inline-item pt-0 pr-1 pb-0 pl-0">
                                    <a  href="{{  route('login') }}">Login</a>/<a href="{{  route('register') }}">Sign
                                        up</a>
                                </li>
                                @endif
                                @else
                                <li class="list-inline-item pt-0 pr-1 pb-0 pl-0">
                                    <a class="nav-item nav-link" href="{{ route('user.dashboard') }}"
                                        class="nav-link mr-4"><b style="font-size:16px; color:#04787d;">My Account</b></a>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="info-text" align="center">
                    {{ config('company.company_name') }} is a {{ config('company.company_name') }} replacement & free
                    {{ config('company.company_name') }} alternative
                    website. {{ config('company.company_name') }} is considered as the best alternative to
                    {{ config('company.company_name') }} website since 2022. Similar to
                    {{ config('company.company_name') }},
                    posting ads
                    in {{ config('company.company_name') }} is free!
                </p>
            </div>
        </div>
        <div class="info-second-text">
            <p>
                In the {{ config('company.company_name') }} classifieds, find your local
                {{ config('company.company_name') }}
                escorts,
                body rubs, strippers, adult jobs, dating services etc.
            </p>
        </div>
    </section>

    <!-- location section -->

    <section id="location-section">
        <div class="container">
            <h4 class="mb-2" style="border-bottom:3px #4E52D0 solid;">Choose a location:</h4>
            <div class="row">
                <!-- Usa -->
                <div class="col-lg-6">
                    <div class="location-box">
                        <div class="location-name text-center">
                            <img src="{{asset('assets/FrontEnd/image/us.svg')}}" width="35px" alt="" />
                            <h3>United States</h3>
                        </div>
                        @include('FrontEnd.Home.usa')
                    </div>
                </div>

                <!-- Canada -->
                <div class="col-lg-6">
                    <div class="location-box">
                        <div class="location-name text-center">
                            <img src="{{asset('assets/FrontEnd/image/Flag_of_Canada.svg')}}" width="35px" alt="" />
                            <h3>Canada</h3>
                        </div>

                        @include('FrontEnd.Home.canada')
                    </div>
                </div>
                <!-- Australia & United Kingdom -->
                <div class="col-lg-12 my-5">
                    <div class="location-box">
                        <div class="location-name text-center">
                            <img src="pic/Flag_of_Australia.svg.png" width="35px" alt="" />
                            <img src="{{asset('assets/image/FrontEnd/Flag_of_the_United_Kingdom.svg.png')}}"
                                width="35px" alt="" />
                            <h3>Australia & United Kingdom</h3>
                        </div>

                        @include('FrontEnd.Home.australia')


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about us section -->
    @include('FrontEnd.Home.aboutus')

</main>
@endsection