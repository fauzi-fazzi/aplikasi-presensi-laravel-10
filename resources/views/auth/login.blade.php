<!DOCTYPE html>
<html lang="en">
<x-header></x-header>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Silakan Login</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ url('/') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="username" name="nim" class="form-control" placeholder="NIM">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <a href="{{ url('/register') }}">
                                    <label for="remember">
                                        Register?
                                    </label>
                                </a>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->

                <!-- /.login-card-body -->
                <!-- /.login-box -->

                <!-- jQuery -->
                <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
                <!-- Bootstrap 4 -->
                <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <!-- AdminLTE App -->
                <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
