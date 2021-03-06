<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id" xml:lang="id">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        function callbackThen(response) {
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data) {
                console.log(data);
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error)
        }
    </script>
    {!! htmlScriptTagJsApi([
    'callback_then' => 'callbackThen',
    'callback_catch' => 'callbackCatch'
    ]) !!}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="Yosef Satrio Aji">
    <meta name="language" content="ID">
    <meta name="url" content="https://yosefsa.my.id">
    @stack('metas')
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA/D8AAP5/AAD+fwAA/n8AAP5/AAD+fwAA/H8AAPy/AAD53wAA8d8AAPPvAADn9wAAx/cAAIfhAAD//wAA" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://kit.fontawesome.com/ce05030a6b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.25.0/themes/prism-okaidia.css" crossorigin="anonymous">
    @stack('styles')
    <style>
        img {
            vertical-align: middle !important;
            border-style: none !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('assets/img/YSA.png')}}" alt="YSALogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="https://yosefsa.xyz" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" action="{{route('search')}}" method="get">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="submit" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <input type="submit" style="display:none">
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <div className="show-icon">
                    <i className="fas fa-compass"></i>
                    <img src="{{asset('assets/img/YSA.png')}}" class="brand-image" style="opacity: .8;filter: invert(100%);">
                </div>
                <span class="brand-text font-weight-light">Yosef's Blog</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                @guest
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item active">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/categories" class="nav-link">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/chat" class="nav-link">
                                <i class="fas fa-comments"></i>
                                <p>
                                    Chat
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/login" class="nav-link">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>
                                    Log in
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/register" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Register
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                @else
                <div class="user-panel mt-3 pb-3 mb-3 flex-column">
                    <div class="image">
                        @if(Auth::user()->avatar)
                        <img src="{{asset('storage/profile_pict/'.Auth::user()->avatar)}}" class="img-circle elevation-2">
                        @else
                        <img src="{{asset('storage/profile_pict/blank.png')}}" class="img-circle elevation-2">
                        @endif
                    </div>
                    <div class="info" style="vertical-align: middle;">
                        <a href="/profile" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item active">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/categories" class="nav-link">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/chat" class="nav-link">
                                <i class="fas fa-comments"></i>
                                <p>
                                    Chat
                                </p>
                            </a>
                        </li>
                        @hasrole('super admin')
                        <li class="nav-item active mt-2 pt-2" style="border-top: 1px solid #4f5962;">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/users" class="nav-link">
                                <i class="av-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Posts
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('post.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Post</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('post.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Published Post</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('post.trash')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trashed Post</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>
                                    Kategori
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('category.list')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('category.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-folder-open"></i>
                                <p>
                                    File Manager
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laravel-filemanager?type=Files" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Files</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laravel-filemanager?type=Images" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Images</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/contact" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Contacts
                                </p>
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item active pt-2 mt-2" style="border-top: 1px solid #4f5962;">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                @endguest
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <footer class="main-footer">
        ?? 2021 Yosef Satrio Aji
    </footer>
    <!-- ./wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.25.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    @stack('scripts')
</body>

</html>
