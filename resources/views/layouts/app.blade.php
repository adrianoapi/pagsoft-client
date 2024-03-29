<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{Route::current()->getName()}} - Pagsoft API</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') !!}" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{!! asset('assets/css/demo.css') !!}" rel="stylesheet">

    <!-- codemirror -->
    <link href="{!! asset('assets/css/plugins/codemirror/codemirror.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/plugins/codemirror/monokai.css') !!}" rel="stylesheet">

    <!-- SUMMERNOTE -->
    <link href="{!! asset('assets/css/plugins/summernote/summernote-bs4.css') !!}" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="/assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.pagsoft.com.br" class="simple-text">
                        Pagsoft API
                    </a>
                </div>
                <ul class="nav">
                    @if(session()->get('access_token'))
                    <li class="nav-item {{Route::current()->getName() === 'dashboard.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('dashboard.index')}}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'user.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('user.index')}}">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Usuários</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'collection.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('collection.index')}}">
                            <i class="nc-icon nc-notes"></i>
                            <p>Coleções (liberado)</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'ledgerEntry.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('ledgerEntry.index')}}">
                            <i class="nc-icon nc-money-coins"></i>
                            <p>Financeiro (liberado)</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'password.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('password.index')}}">
                            <i class="nc-icon nc-lock-circle-open"></i>
                            <p>Senhas (liberado)</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'event.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('event.index')}}">
                            <i class="nc-icon nc-time-alarm"></i>
                            <p>Agenda (liberado)</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'diagram.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('diagram.index')}}">
                            <i class="nc-icon nc-layers-3"></i>
                            <p>Diagram</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'diagram.mail' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('diagram.index')}}">
                            <i class="nc-icon nc-email-83"></i>
                            <p>Mail</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'client.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('client.index')}}">
                            <i class="nc-icon nc-bag"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'cronJob.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('cronJob.index')}}">
                            <i class="nc-icon nc-watch-time"></i>
                            <p>Cron Job</p>
                        </a>
                    </li>
                    <li class="nav-item {{Route::current()->getName() === 'mania.sorteios' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('mania.sorteios')}}">
                            <i class="nc-icon nc-controller-modern"></i>
                            <p>Sorteios</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @if(session()->get('access_token'))
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Table List </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Another notification</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <span class="d-lg-block">&nbsp;Search</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Dropdown</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login.logout')}}">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @endif
            <!-- End Navbar -->
            @yield('content')
            <footer class="footer">
                <div class="container-fluid">

                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{!! asset('assets/js/core/jquery.3.2.1.min.js') !!}"></script>
<script src="{!! asset('assets/js/core/popper.min.js') !!}"></script>
<script src="{!! asset('assets/js/core/bootstrap.min.js') !!}"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{!! asset('assets/js/plugins/bootstrap-switch.js') !!}"></script>

<!--  Chartist Plugin  -->
<script src="{!! asset('assets/js/plugins/chartist.min.js') !!}"></script>
<!--  Notifications Plugin    -->
<script src="{!! asset('assets/js/plugins/bootstrap-notify.js') !!}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{!! asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') !!}"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{!! asset('assets/js/demo.js') !!}"></script>

<!-- codemirror -->
<!-- CodeMirror -->
<script src="{!! asset('assets/js/plugins/codemirror/codemirror.js') !!}"></script>
<script src="{!! asset('assets/js/plugins/codemirror/mode/javascript/javascript.js') !!}"></script>

<!-- SUMMERNOTE -->
<script src="{!! asset('assets/js/plugins/summernote/summernote-bs4.js') !!}"></script>


@section('scripts')
@show

</html>
