<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/login-form-10/login-form-10/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/login-form-10/login-form-10/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('backend/login-form-10/login-form-10/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('backend/login-form-10/login-form-10/css/style.css') }}">

    <title>Login</title>
</head>
<style>
    .form-control {
        text-align: center;
    }
</style>

<body>
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <div class="form-block">
                        <div class="mb-4">
                            <h3>Sign In to <strong>INFOTANI-KK</strong></h3>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group first">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" id="name" name="name" :value="old('name')">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">

                            </div>
                            <hr>

                            <input type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-primary">
                        </form>
                    </div>
                </div>
                <div class="col-md-4 contents"></div>
            </div>
        </div>
    </div>


    <script src="{{ 'backend/login-form-10/login-form-10/js/jquery-3.3.1.min.js' }}"></script>
    <script src="{{ 'backend/login-form-10/login-form-10/js/popper.min.js' }}"></script>
    <script src="{{ 'backend/login-form-10/login-form-10/js/bootstrap.min.js' }}"></script>
    <script src="{{ 'backend/login-form-10/login-form-10/js/main.js' }}"></script>
</body>

</html>
