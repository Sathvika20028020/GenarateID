<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Zeta admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Zeta admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('/theme/images/BBMPlogo.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/theme/images/BBMPlogo.png')}}" type="image/x-icon">
    <title>Generate ID Card</title>
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('/theme/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/responsive.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background: url("{{ asset('/theme/video/original-background.gif')}}") no-repeat center center fixed;
        background-size: cover;
    }

    @media (max-width:1350px) {
        .login-form {
            width: auto !important;
        }
    }
</style>

<body>
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <div class="container-fluid">
            <div class="row m-0">
                <div class="col-lg-12 col-sm-12">
                    <div class="login-card p-3" style="  height:auto">
                        <div class="theme-form col-md-9 p-4 shadow"
                            style=" background-color:white;border:1px solid #00000047;border-radius: 10px;">
                            <div class="d-flex row align-items-center">
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="d-flex flex-row gap-1 align-items-center justify-content-center">
                                        <img src="{{ asset('/theme/images/BBMPlogo.png')}}" width="15%;" alt="">
                                        <h6 class="text-dark fw-bold text-center">
                                            Generate ID Card
                                        </h6>
                                        <img src="{{ asset('/theme/images/logo/logo-icon.jpg')}}" width="15%;" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <h4 class="text-center" style="color:#2a1570;">Login to your Account
                                    </h4>
                                    <h5 class="text-start mb-3 text-dark mt-5 mb-2 fs-5"></h5>
                                    <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                                      @csrf
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                                <input id="email" placeholder="Test@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                                <input id="password" placeholder="*********" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i id="toggleIcon" class="fa-solid fa-eye-slash"
                                                        style="cursor: pointer;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between gap-2 flex-wrap">

                                            <a type="submit" href="{{ route('password.request') }}" class="btn btn-primary">
                                                Forgot Password?
                                            </a>

                                            <button href="dashboard.html" class="btn btn-primary">
                                                Log-in
                                            </button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer start-->

    </div>
    </div>

    <script>
        document.querySelector(".login-form").addEventListener("submit", function (e) {
             // stop real form submission

            // Optional: Add very basic front-end validation
            let email = document.querySelector("input[name='email']").value.trim();
            let password = document.querySelector("input[name='password']").value.trim();

            if (email === "" || password === "") {
                e.preventDefault();
                alert("Please enter Email and Password!");
                return;
            }
        });
    </script>

    <!-- latest jquery-->
    <script src="{{ asset('/theme/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('/theme/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('/theme/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('/theme/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('/theme/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{ asset('/theme/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/theme/js/config.js')}}"></script>
    <!-- Theme js-->
    <script src="{{ asset('/theme/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>