
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Demensi Studio</title>
    <meta name="description" content="Login internal Demensi Studio">

    <link rel="icon" type="image/png" href="{{ asset('assets-admin/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at 12% 15%, rgba(166, 166, 166, .09), transparent 30%),
                radial-gradient(circle at 88% 85%, rgba(166, 166, 166, .08), transparent 28%),
                #FFFFFF;
            color: #111111;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow-x: hidden;
        }

        /* Login wrapper */
        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        /* Brand */
        .login-brand {
            text-align: center;
            margin-bottom: 32px;
            animation: brandReveal .8s ease both;
        }

        .login-brand h1 {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: .12em;
            margin: 0;
            transition: letter-spacing .35s ease;
        }

        .login-brand:hover h1 {
            letter-spacing: .16em;
        }

        .login-brand p {
            color: #A6A6A6;
            font-size: .72rem;
            letter-spacing: .25em;
            margin-top: 8px;
            margin-bottom: 0;
        }

        /* Login card */
        .login-card {
            position: relative;
            overflow: hidden;
            background: #FFFFFF;
            border: 1px solid #E5E5E5;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 12px 40px rgba(17, 17, 17, .035);
            animation: cardReveal .8s .12s ease both;
            transition: box-shadow .3s ease, border-color .3s ease;
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 32px;
            right: 32px;
            height: 2px;
            background: #A6A6A6;
            opacity: .65;
        }

        .login-card:hover {
            border-color: #DADADA;
            box-shadow: 0 16px 45px rgba(17, 17, 17, .055);
        }

        /* Heading */
        .login-heading {
            margin-bottom: 26px;
        }

        .login-heading h2 {
            font-size: 1.35rem;
            font-weight: 750;
            margin-bottom: 7px;
        }

        .login-heading p {
            color: #A6A6A6;
            font-size: .82rem;
            margin: 0;
        }

        /* Form */
        .form-label {
            font-size: .8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 46px;
            border: 1px solid #DADADA;
            border-radius: 8px;
            font-size: .85rem;
            box-shadow: none;
            transition: border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease;
        }

        .form-control:focus {
            border-color: #111111;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(17, 17, 17, .055);
        }

        .form-control::placeholder {
            color: #A6A6A6;
            opacity: 1;
        }

        /* Password field */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #888888;
            padding: 4px;
            cursor: pointer;
            transition: color .2s ease;
        }

        .password-toggle:hover {
            color: #111111;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #A6A6A6;
            outline-offset: 3px;
            border-radius: 4px;
        }

        /* Remember */
        .remember-label {
            color: #777777;
            font-size: .78rem;
            cursor: pointer;
        }

        .form-check-input {
            cursor: pointer;
            border-color: #C5C5C5;
            box-shadow: none !important;
        }

        .form-check-input:checked {
            background-color: #111111;
            border-color: #111111;
        }

        /* Login button */
        .login-button {
            width: 100%;
            min-height: 46px;
            border: 1px solid #111111;
            border-radius: 8px;
            background: #111111;
            color: #FFFFFF;
            font-size: .85rem;
            font-weight: 700;
            transition: transform .25s ease,
                background .25s ease,
                border-color .25s ease,
                color .25s ease,
                box-shadow .25s ease;
        }

        .login-button:hover {
            background: #A6A6A6;
            border-color: #A6A6A6;
            color: #111111;
            transform: translateY(-2px);
            box-shadow: 0 7px 16px rgba(17, 17, 17, .13);
        }

        .login-button:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .login-button i {
            display: inline-block;
            transition: transform .25s ease;
        }

        .login-button:hover i {
            transform: translateX(4px);
        }

        /* Alerts */
        .login-card .alert {
            font-size: .78rem;
            border-radius: 8px;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            color: #A6A6A6;
            font-size: .7rem;
            line-height: 1.6;
            margin-top: 25px;
            animation: footerReveal .8s .3s ease both;
        }

        /* Animation */
        @keyframes brandReveal {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes cardReveal {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes footerReveal {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media(max-width:480px) {
            body {
                padding: 20px;
            }

            .login-brand {
                margin-bottom: 26px;
            }

            .login-card {
                padding: 25px 22px;
            }

            .login-heading h2 {
                font-size: 1.25rem;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        {{-- Brand --}}
        <div class="login-brand">
            <h1>DIMENSI</h1>
            <p>HAIR STUDIO</p>
        </div>

        {{-- Login Card --}}
        <div class="login-card">

            <div class="login-heading">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk untuk mengakses dashboard studio.</p>
            </div>

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="alert alert-success small" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Notification --}}
            @if($errors->any())
                <div class="alert alert-danger small" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        autofocus>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>

                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                            aria-pressed="false">

                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="remember"
                            name="remember"
                            value="1"
                            @checked(old('remember'))>

                        <label class="form-check-label remember-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="login-button">
                    MASUK <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </form>

        </div>

        {{-- Footer --}}
        <div class="login-footer">
            &copy; {{ date('Y') }} Demensi Studio. All rights reserved.
            <br>
            Akses khusus Owner dan Barber.
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const passwordIcon = document.getElementById('passwordIcon');

            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';

                passwordInput.type = isPassword ? 'text' : 'password';

                passwordIcon.classList.toggle('bi-eye', !isPassword);
                passwordIcon.classList.toggle('bi-eye-slash', isPassword);

                togglePassword.setAttribute(
                    'aria-label',
                    isPassword ? 'Sembunyikan password' : 'Tampilkan password'
                );

                togglePassword.setAttribute(
                    'aria-pressed',
                    isPassword ? 'true' : 'false'
                );
            });
        });
    </script>

</body>
</html>
