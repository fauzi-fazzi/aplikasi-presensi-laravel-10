<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav">
        <!-- Navbar Logout -->
        <li class="nav-item">
            <form method="POST" action="{{ url('logoutadmin') }}">
                @csrf
                <button class="btn nav-link" data-widget="navbar-logout" href="#" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </li>

    </ul>
</nav>
