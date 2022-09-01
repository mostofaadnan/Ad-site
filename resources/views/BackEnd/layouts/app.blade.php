<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->

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

    <!--plugins-->
    @yield("style")
    <link href="{{asset('assets/BackEnd/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/BackEnd/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/BackEnd/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/BackEnd/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/css/bootstrap-extended.css')}}" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/dataTables.bootstrap4.min.css')}}">
    <!-- <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/autoFill.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/colReorder.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/keyTable.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/searchPanes.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/fixedHeader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/fixedColumns.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/datatables/select.dataTables.min.css')}}">



    <!-- select -->
    <link href="{{asset('assets/BackEnd/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />

    <!--    Date -->
    <link href="{{asset('assets/BackEnd/plugins/datetimepicker/css/classic.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/datetimepicker/css/classic.time.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/BackEnd/plugins/datetimepicker/css/classic.date.css')}}" rel="stylesheet" />
    <link rel="stylesheet"
        href="{{asset('assets/BackEnd/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Custom -->

    <link href="{{asset('assets/BackEnd/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/BackEnd/css/icons.css')}}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/BackEnd/css/header-colors.css')}}" />


    <script src="{{asset('assets/BackEnd/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('assets/BackEnd/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- DateTime -->
    <script src="{{asset('assets/BackEnd/plugins/datetimepicker/js/legacy.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/datetimepicker/js/picker.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/datetimepicker/js/picker.time.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/datetimepicker/js/picker.date.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>

    <script
        src="{{asset('assets/BackEnd/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}">
    </script>
    <!--     <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script> -->
    <script src="{{asset('assets/BackEnd/js/sweetalert/sweetalert.min.js')}}"></script>


    <title>{{ config('company.company_name') }}</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--navigation-->
        @include("BackEnd.layouts.nav")
        <!--end navigation-->

        <!--start header -->
        @include("BackEnd.layouts.header")
        <!--end header -->

        <!--start page wrapper -->

        @yield("wrapper")


        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">{{ config('company.copy_rights') }}</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
            <hr />
            <h6 class="mb-0">Sidebar Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <!-- DataTable -->

    <script src="{{asset('assets/BackEnd/js/datatables/fixedHeader.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables//vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.searchPanes.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/fixedHeader.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.fixedColumns.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/sum/sum.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/BackEnd/js/datatables/dataTables.select.min.js')}}"></script>


    <script src="{{asset('assets/BackEnd/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/BackEnd/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <!--app JS-->
    <script src="{{asset('assets/BackEnd/js/app.js')}}"></script>
    <!--    <script src="{{asset('assets/js/custom.js')}}"></script> -->

    <script src="{{asset('assets/BackEnd/plugins/select2/js/select2.min.js')}}"></script>
    <script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    </script>
    <script>
    function ThemeSetLoad(data) {
        var theme = data.theme_style;
        switch (theme) {
            case 'light-theme':
                $('html').attr('class', 'light-theme');
                break;
            case 'dark-theme':
                $('html').attr('class', 'dark-theme');
                break;
            case 'semi-dark':
                $('html').attr('class', 'semi-dark');
                break;
            case 'minimal-theme':
                $('html').attr('class', 'minimal-theme');
                break;

            default:
                break;
        }
        /*   var headercolor = data.header_color;
          switch (headercolor) {
              case 'headercolor1':
                  $("html").addClass("color-header headercolor1");
                  $("html").removeClass(
                      "headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
                  break;
              case 'headercolor2':
                  $("html").addClass("color-header headercolor2");
                  $("html").removeClass(
                      "headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
                  break;
              case 'headercolor3':
                  $("html").addClass("color-header headercolor3");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
                  break;
              case 'headercolor4':
                  $("html").addClass("color-header headercolor4");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8");
                  break;
              case 'headercolor5':
                  $("html").addClass("color-header headercolor5");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8");
                  break;
              case 'headercolor6':
                  $("html").addClass("color-header headercolor6");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8");
                  break;
              case 'headercolor7':
                  $("html").addClass("color-header headercolor7");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8");
                  break;
              case 'headercolor8':
                  $("html").addClass("color-header headercolor8");
                  $("html").removeClass(
                      "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3");
                  break;

              default:
                  break;


          } */

        /*  var sidebar = data.sidebar_color;

         switch (sidebar) {
             case 'sidebarcolor1':
                 $('html').attr('class', 'color-sidebar sidebarcolor1');
                
                 break;
             case 'sidebarcolor2':
                 $('html').attr('class', 'color-sidebar sidebarcolor2');
        
                 break;
             case 'sidebarcolor3':
                 $('html').attr('class', 'color-sidebar sidebarcolor3');
                 break;
             case 'sidebarcolor4':
                
                 $('html').attr('class', 'color-sidebar sidebarcolor4');
                 break;
             case 'sidebarcolor5':
                
                 $('html').attr('class', 'color-sidebar sidebarcolor5');
                 break;
             case 'sidebarcolor6':
            
                 $('html').attr('class', 'color-sidebar sidebarcolor6');
                 break;
             case 'sidebarcolor7':
                
                 $('html').attr('class', 'color-sidebar sidebarcolor7');
                 break;
             case 'sidebarcolor8':
                
                 $('html').attr('class', 'color-sidebar sidebarcolor8');
                 break;
             default:
                 break;

         } */
    }
    // window.onload = ThemeDesign();
    </script>
    @yield("script")
    <!--   @include("BackEnd.layouts.theme-control") -->
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <!-- <div id="overlay">
        <div class="cv-spinner" role="status">
            <span class="spinner visually-hidden">Loading...</span>
        </div>
    </div> -->
</body>

</html>