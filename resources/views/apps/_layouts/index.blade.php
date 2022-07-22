<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Pemilihan Ketua OSIS &mdash; SMA 2 Bone</title>

        @stack('cssScript')

</head>

<body class="layout-3">
        <div id="app">
                <div class="main-wrapper container">
                        <div class="navbar-bg" style="height: 65px;"></div>
                        <nav class="navbar navbar-expand-lg main-navbar">
                                <a href="index.html" class="navbar-brand sidebar-gone-hide">SMA 2 Bone</a>
                                <div class="navbar-nav">
                                        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                                </div>
                                <form class="form-inline ml-auto">

                                </form>
                                <ul class="navbar-nav navbar-right">
                                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Helper::get_data('students')->where('id',Session::get('user'))->first()->name }}</div>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger">
                                                                <i class="fas fa-sign-out-alt"></i> Logout
                                                        </a>
                                                </div>
                                        </li>
                                </ul>
                        </nav>
                        <div class="main-content">
                                <section class="section">
                                        <div>
                                                @yield('content')
                                        </div>
                                        @include('apps._layouts.footer')
                                </section>
                        </div>
                </div>

        </div>

        @stack('jsScript')

        @stack('jsScriptAjax')

</body>

</html>