<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('logo bener.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Aplikasi Absensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('user')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{ url('panel') }}"
                        class="nav-link {{ Request::is('panel/*') || Request::is('panel') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('anggota') }}"
                        class="nav-link {{ Request::is('anggota/*') || Request::is('anggota') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Data Anggota
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('absen') }}"
                        class="nav-link {{ Request::is('absen/*') || Request::is('absen') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Data Absensi
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('monitoringkegiatan') }}"
                        class="nav-link {{ Request::is('monitoringkegiatan/*') || Request::is('monitoringkegiatan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Data Kegiatan
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('setlokasi') }}"
                        class="nav-link {{ Request::is('setlokasi/*') || Request::is('setlokasi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map"></i>
                        <p>
                            Lokasi
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('pengajuanizin') }}"
                        class="nav-link {{ Request::is('pengajuanizin/*') || Request::is('pengajuanizin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-slash"></i>
                        <p>
                            Izin
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('laporan/*') || Request::is('laporan/') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('laporan/*') || Request::is('laporan/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('laporan/absensi') }}"
                                class="nav-link {{ Request::is('laporan/absensi/*') || Request::is('laporan/absensi') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Rekap Absensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('laporan/kegiatan') }}"
                                class="nav-link {{ Request::is('laporan/kegiatan/*') || Request::is('laporan/kegiatan') ? 'active' : '' }}">
                                <i class="fas fa-file-medical-alt nav-icon"></i>
                                <p>Rekap Kegiatan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" href="{{ url('logoutadmin') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ url('logoutadmin') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
