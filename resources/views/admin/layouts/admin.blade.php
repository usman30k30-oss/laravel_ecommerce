<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-white navbar-light">
        <a href="#" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
    
        
        <form method="GET" action="/products" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input 
                    class="form-control form-control-navbar" 
                    type="search" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    value="{{ request('search') }}"
                >
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary">

        <a href="/admin" class="brand-link">Admin Panel</a>
        <div class="sidebar">

            <!-- User Panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ asset('uploads/users/' . (auth()->user()->image ?? 'default.png')) }}"
                        class="img-circle elevation-2"
                        style="width:35px; height:35px; object-fit:cover;"
                    >
                </div>
                <div class="info ml-2">
                    <a href="#" class="d-block">
                        {{ auth()->user()->name }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="/admin" class="nav-link  {{ request()->is('admin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/products" class="nav-link  {{ request()->is('products*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Products</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/categories" class="nav-link  {{ request()->is('categories*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Categories</p>
                        </a>
                    </li>

                </ul>
            </nav>

        </div>

    </aside>

    <!-- Content -->
    <div class="content-wrapper p-3">
    @yield('content')
    </div>

</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

</body>
</html>