<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Social-E') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    <style>
        .loader,
        .loader:before,
        .loader:after {
            border-radius: 50%;
        }

        .loader {
            color: #ffffff;
            font-size: 11px;
            text-indent: -99999em;
            margin: 55px auto;
            position: relative;
            width: 10em;
            height: 10em;
            box-shadow: inset 0 0 0 1em;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .loader:before,
        .loader:after {
            position: absolute;
            content: '';
        }

        .loader:before {
            width: 5.2em;
            height: 10.2em;
            background: #4e73df;
            border-radius: 10.2em 0 0 10.2em;
            top: -0.1em;
            left: -0.1em;
            -webkit-transform-origin: 5.1em 5.1em;
            transform-origin: 5.1em 5.1em;
            -webkit-animation: load2 2s infinite ease 1.5s;
            animation: load2 2s infinite ease 1.5s;
        }

        .loader:after {
            width: 5.2em;
            height: 10.2em;
            background: #4e73df;
            border-radius: 0 10.2em 10.2em 0;
            top: -0.1em;
            left: 4.9em;
            -webkit-transform-origin: 0.1em 5.1em;
            transform-origin: 0.1em 5.1em;
            -webkit-animation: load2 2s infinite ease;
            animation: load2 2s infinite ease;
        }

        @-webkit-keyframes load2 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes load2 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }


        #loadingDiv {
            position: absolute;
            ;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #4e73df;
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                {{-- <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div> --}}
                <div class="sidebar-brand-text mx-3">Social-E</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            {{-- <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div> --}}

            <!-- Nav Item - Profile -->
            {{-- <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>

        <!-- Nav Item - About -->
        <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('About') }}</span>
            </a>
        </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('statistics') }}">
                    <i class="bi bi-cash"></i>
                    <span>{{ __('Statistics') }}</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('statistics') }}">
                    <i class="bi bi-cash"></i>
                    <span>{{ __('Statistics') }}</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="{{ url('payment_history') }}">
                    <i class="bi bi-cash"></i>
                    <span>{{ __('Payment History') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('approved_instructor') }}">
                    <i class="bi bi-check2-circle"></i>
                    <span>{{ __('Approved Instructor') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('student_list') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>{{ __('Student List') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('tutorial') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Intro') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('courses') }}">
                    <i class="bi bi-book-half"></i>
                    <span>{{ __('Course Approval') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('course_type') }}">
                    <i class="bi bi-book-half"></i>
                    <span>{{ __('Course Type') }}</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Bag Pack') }}</span>
                </a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure> --}}

                                @if ($user_data->user_image != null)
                                    <img src="{{ asset('/storage/' . $user_data->user_image) }}"
                                        class="img-profile rounded-circle" alt="">
                                @else
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span>
                                    <figure class="img-profile rounded-circle avatar font-weight-bold"
                                        data-initial="{{ Auth::user()->name[0] }}"></figure>
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Social-E {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- Scripts -->
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
        $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function() {
            setTimeout(removeLoader, 500); //wait for page load PLUS two seconds.
        });

        function removeLoader() {
            $("#loadingDiv").fadeOut(500, function() {
                // fadeOut complete. Remove the loading div
                $("#loadingDiv").remove(); //makes page more lightweight 
            });
        }
    </script>


</body>

</html>
