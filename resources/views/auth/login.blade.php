<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
    <!-- Bootstrap -->
    <link href="{{ asset('assets') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('assets') }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets') }}/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/particles') }}/css/style.css" />
    <style>
        .text-danger {
            color: red;
        }

        .form-error {
            /* border: 2px solid red; */
            border: 2px solid #fd0000;
        }
    </style>
</head>

<body class="login" id="particles-js">
    {{-- <div id="particles-js"> --}}
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <a class="hiddenanchor" id="forgot-password"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form type="POST" enctype="multipart/form-data" id="formLogin">
                        <h1>Login Form</h1>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="Example@example.com" name="email"
                                id="email" />
                            <span class="text-danger form-validate" id="emailError"></span>
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password" />
                            <span class="text-danger form-validate" id="passwordError"></span>
                        </div>
                        <div>
                            <div id="buttonLogin">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <div id="buttonLoginLoading" style="display: none;">
                                <button type="submit" class="btn btn-primary btn-block" disabled><i
                                        class="fa fa-spinner fa-spin">Process</i></button>
                            </div>
                            {{-- <a class="reset_pass" href="#">Lost your password?</a> --}}
                        </div>

                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p>
                            <p class="change_link">forgot password?
                                <a href="#forgot-password" class="to_forgot"> forgot password </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i></h1>
                                <p>©2023 All Rights Reserved. Mnifa! is a Bootstrap 4 template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <h1>to register an account contact the admin</h1>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw"></i></h1>
                            <p>©2023 All Rights Reserved. Mnifa! is a Bootstrap 4 template. Privacy and
                                Terms</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- particles --}}

    <script src="{{ asset('assets/particles/particles.js') }}"></script>
    <script src="{{ asset('assets/particles/js/app.js') }}"></script>
    <script>
        particlesJS.load("particles-js", "particlesjs-config.json", function() {
            console.log("callback - particles.js config loaded");
        });
    </script>
    {{-- endparticles --}}

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();
                document.getElementById("buttonLogin").style
                    .display = "block";
                document.getElementById("buttonLoginLoading").style
                    .display = "none";
                var email = $("#email").val();
                var password = $("#password").val();
                var token = $("meta[name='csrf-token']").attr("content");
                let validation = 0;

                //validation
                if (email.length == 0 || email == "") {
                    $('#emailError').text("email is required");
                    $('#email').addClass('form-error');
                    validation++
                } else {
                    if (!email.toString().toLowerCase().match(
                            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        )) {
                        $('#emailError').text("Plase check the email format");
                        $('#email').addClass('form-error');
                        validation++;
                    } else {
                        $('#emailError').text("");
                        $('#email').removeClass('form-error');
                    }
                }
                //password validation
                if (password.length == 0 || password == "") {
                    $('#passwordError').text("Password is required");
                    $('#password').addClass('form-error');
                } else {
                    $('#passwordError').text("");
                    $('#password').removeClass('form-error');
                }
                //validation lebih dari 0
                if (validation > 0) {
                    document.getElementById("buttonLogin").style
                        .display = "block";
                    document.getElementById("buttonLoginLoading").style
                        .display = "none";
                    return false;
                }

                $.ajax({
                    url: "{{ route('login.action') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        "email": email,
                        "password": password,
                        "_token": token
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Login Success...',
                                    text: 'You will redirected into system 3 second',
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                })
                                .then(function() {
                                    window.location.href = response.data.url_redirect;
                                });
                        } else {

                            Swal.fire({
                                    title: 'Login Failed...',
                                    text: response.message,
                                    icon: 'error',
                                })
                                .then(function() {
                                    document.getElementById("buttonLogin").style
                                        .display = "block";
                                    document.getElementById("buttonLoginLoading").style
                                        .display = "none";
                                });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Opps!',
                            text: response.message
                        }).then(function() {
                            document.getElementById("buttonRegisterUser").style
                                .display = "block";
                            document.getElementById("buttonRegisterUserLoading").style
                                .display = "none";
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
