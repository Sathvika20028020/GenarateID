<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate ID Card | Login</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('/theme/css/color-1.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('/theme/css/responsive.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Premium Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background:
               linear-gradient(135deg, #f8fbff 0%, #eef4ff 45%, #f4f0ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-wrapper {
            width: 100%;
            padding: 30px 15px;
        }

        .premium-card {
            max-width: 1050px;
            margin: auto;
            border-radius: 26px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 25px 60px rgba(80, 110, 180, 0.18);
            animation: fadeUp 0.7s ease;
        }

        .left-panel {
           background: linear-gradient(145deg, #edf4ff, #f5efff);
            color: #2a1570;
            padding: 60px 40px;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-right: 1px solid rgba(42, 21, 112, 0.08);
        }

        .left-panel .branding {
            width: 100%;
        }

        .right-panel {
            background: rgba(255, 255, 255, 0.97);
            padding: 60px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
        }

        .login-title {
            color: #1f2a44;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #7b8190;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2b2b2b;
            display: block;
            font-size: 14px;
        }

        .input-group {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #dde3f0;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.03);
        }

        .input-group:focus-within {
            border-color: #4c6fff;
            box-shadow: 0 0 0 4px rgba(76, 111, 255, 0.12);
            transform: translateY(-1px);
        }

        .input-group-text {
            background: #f8faff;
            border: none;
            color: #7a8191;
            padding: 14px 16px;
        }

        .form-control {
            border: none !important;
            box-shadow: none !important;
            padding: 15px 14px;
            font-size: 15px;
            background: #fff;
        }

        .form-control::placeholder {
            color: #a0a7b4;
        }

        .btn-premium {
            background: linear-gradient(135deg, #2a1570, #4c6fff);
            color: #fff;
            border: none;
            border-radius: 16px;
            padding: 13px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 12px 28px rgba(76, 111, 255, 0.25);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            color: #fff;
            box-shadow: 0 16px 34px rgba(76, 111, 255, 0.32);
        }

        .btn-soft {
            background: #eef2ff;
            color: #2a1570;
            border: none;
            border-radius: 16px;
            padding: 13px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-soft:hover {
            background: #dde5ff;
            color: #2a1570;
        }

        .bottom-note {
            margin-top: 28px;
            font-size: 13px;
            color: #7b8190;
            text-align: center;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .single-brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            padding: 18px 28px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(14px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
            flex-wrap: nowrap;
        }

        .single-brand-icon {
            width: 72px !important;
            height: 72px !important;
            object-fit: contain;
            padding: 10px !important;
            margin: 0 !important;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: none !important;
        }

        .single-brand-text {
            font-size: 2.2rem;
            font-weight: 800;
            color: #2a1570;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
            white-space: nowrap;
            line-height: 1;
        }

        @media (max-width: 991px) {
            .left-panel {
                padding: 45px 25px;
            }

            .right-panel {
                padding: 40px 28px;
            }
        }

        @media (max-width: 768px) {
            .single-brand-logo {
                gap: 12px;
                padding: 14px 18px;
            }

            .single-brand-icon {
                width: 56px !important;
                height: 56px !important;
                padding: 8px !important;
            }

            .single-brand-text {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 576px) {
            .login-title {
                font-size: 1.6rem;
            }

            .right-panel {
                padding: 30px 20px;
            }

            .btn-premium,
            .btn-soft {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="premium-card">
            <div class="row g-0">

                <!-- Left Panel -->
                <div class="col-lg-6">
                    <div class="left-panel">
                        <div class="branding">
                            <div class="single-brand-logo">
                                <img src="{{ asset('/theme/images/logoicon2.png') }}" alt="Portal Logo"
                                    class="single-brand-icon">

                                <span class="single-brand-text">Generate ID</span>

                                <img src="{{ asset('/theme/images/logoicon1.png') }}" alt="Portal Logo"
                                    class="single-brand-icon">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="col-lg-6">
                    <div class="right-panel">
                        <h3 class="login-title">Login to your Account</h3>
                        <p class="login-subtitle">Enter your credentials to access the dashboard.</p>

                        <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input id="email" placeholder="Enter your email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="text-danger small d-block mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input id="password" placeholder="Enter your password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                        <i id="toggleIcon" class="fa-solid fa-eye-slash"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="text-danger small d-block mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div
                                class="d-flex justify-content-between align-items-center gap-3 flex-wrap action-buttons mt-4">
                                <a href="{{ route('forgot') }}" class="btn btn-soft">
                                    Forgot Password?
                                </a>

                                <button type="submit" class="btn btn-premium">
                                    <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
                                </button>
                            </div>

                            <div class="bottom-note">
                                © {{ date('Y') }} Generate ID Card. All rights reserved.
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }

        document.querySelector(".login-form").addEventListener("submit", function (e) {
            let email = document.querySelector("input[name='email']").value.trim();
            let password = document.querySelector("input[name='password']").value.trim();

            if (email === "" || password === "") {
                e.preventDefault();
                alert("Please enter Email and Password!");
                return;
            }
        });
    </script>

    <!-- JS -->
    <script src="{{ asset('/theme/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('/theme/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/theme/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('/theme/js/icons/feather-icon/feather-icon.js')}}"></script>
    <script src="{{ asset('/theme/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{ asset('/theme/js/scrollbar/custom.js')}}"></script>
    <script src="{{ asset('/theme/js/config.js')}}"></script>
    <script src="{{ asset('/theme/js/script.js')}}"></script>
</body>

</html>