@extends('layouts.app')
@section('content')

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; margin: 0; background-color: #f7f7f7;">

    <div class="container">
        <div class="wrapper-login w-100">
            <div class="container container-login animated fadeIn">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="card shadow">
                            <div class="card-body p-5">
                                <h3 class="text-center mb-4">Welcome Back!</h3>
                                <div class="login-form">
                                    <form action="../../index.html">
                                        <div class="form-group">
                                            <label for="username" class="placeholder">Username</label>
                                            <input id="username" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="placeholder">Password</label>
                                            <div class="position-relative">
                                                <input id="password" type="password" class="form-control" required>
                                                <div class="show-password">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="rememberme">
                                                <label class="custom-control-label" for="rememberme">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-action-d-flex mb-0">
                                            <button type="submit" class="btn btn-primary btn-rounded btn-login w-100">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection