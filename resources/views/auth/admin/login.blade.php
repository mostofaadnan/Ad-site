<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('assets/BackEnd/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/BackEnd/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/BackEnd/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/BackEnd/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/css/icons.css')}}" rel="stylesheet">
    <title>{{ config('company.company_name') }}</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="authentication-header"></div>
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="assets/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <div class="brand_logo_container">
                                        <img src="{{ asset('image/logo/'.config('company.main_logo')) }}" class="brand_logo" alt="Logo">
                                    </div>
                                </div>
                                <div class="p-4 rounded" style="margin-top:50px;">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                    </div>
                                </div>
                                <div class="form-body">
                                    @if(Session::has('erors'))
                                    <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                           
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-danger">Fail!</h6>
                                                <div>{{Session::get('erors')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <form class="row g-3" method="POST" action="{{ route('admin.login.submit') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress"
                                                class="form-label">{{ __('Email Address') }}</label>
                                            <!-- <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address"> -->
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Email Address" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword"
                                                class="form-label">{{ __('Password') }}</label>
                                            <div class="input-group" id="show_hide_password">
                                                <!-- <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> -->
                                                <input id="password" type="password"
                                                    class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"><a
                                                    href="javascript:;" class="input-group-text bg-transparent"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}
                                                    id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <!--   <div class="col-md-8 text-end">
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                        </div> -->
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/BackEnd/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/BackEnd/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/BackEnd//plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/BackEnd//plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('assets/BackEnd//plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <!--Password show & hide js -->
    <script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
    </script>
    <!--app JS-->
    <script src="{{ asset('assets/BackEnd//js/app.js')}}"></script>
</body>

</html>