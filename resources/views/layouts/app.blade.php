<!DOCTYPE html>
<html lang="en">

<x-header></x-header>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('logo bener.png') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">E-Presensi</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="ml-auto navbar-nav">
                <!-- Navbar Logout -->
                <li class="nav-item">
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button class="btn nav-link" data-widget="navbar-logout" href="#" role="button">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- <x-sidebar></x-sidebar> --}}

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->
            <!-- Main content -->
            @yield('content')
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <x-footer></x-footer>
</body>

</html>
