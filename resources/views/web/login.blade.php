<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>CEGA ELECTIONS-Login</title>

    <!-- Fonts -->

    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>

    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">
</head>
<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    &nbsp;
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">CEGA Elections</h4>
                        <form method="POST" class="my-login-validation">
                            <div class="form-group">
                                <label for="reg-number">Membership or Phone Number</label>
                                <input type="text" type="text" class="form-control" name="reg-number" id="membership-number">
                            </div>

                            <div class="form-group d-none" id="otp-input">
                                <label for="otp">OTP</label>
                                <input id="otp" type="text" class="form-control" name="otp">
                            </div>

                            <div class="form-group m-0" id="otp-button">
                                <button type="button" class="btn btn-outline-info btn-block" id="getOtp">
                                    GET OTP
                                </button>
                                <button class="btn btn-info d-none btn-block" type="button" disabled id="loading-button">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Sending OTP
                                </button>
                            </div>
                            <div class="form-group m-0 d-none" id="login-input">
                                <button type="button" class="btn btn-outline-info btn-block" id="sign-in-button">
                                    Login
                                </button>
                                <button class="btn btn-info d-none btn-block" type="button" disabled id="login-loading">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Logging in..
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer">

                </div>
            </div>
        </div>
    </div>
</section>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>


<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/toast.js')}}"></script>
<script src="{{asset('js/authentication.js')}}"></script>

</body>
</html>
