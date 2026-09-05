<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Cookies Intan</title>

    <!-- Favicon / App Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Fredoka:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --cream: #FFF8F0;
            --cream-dark: #F5EDE0;
            --brown-light: #C8956C;
            --brown: #8B5E3C;
            --brown-dark: #5C3D1E;
            --brown-darker: #3D2409;
            --chocolate: #2C1A0E;
            --gold: #D4A847;
            --orange: #E8892A;
            --text-dark: #2C1A0E;
            --text-muted: #846750;
            --shadow-md: 0 10px 30px rgba(140, 94, 60, 0.15);
            --shadow-lg: 0 20px 45px rgba(140, 94, 60, 0.22);
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-full: 9999px;
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif; /* body/isi teks */
            background: linear-gradient(135deg, #FFF8F0 0%, #F5EDE0 50%, #EDD9C0 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient floating bakery accents */
        .ambient-shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.25;
            filter: blur(50px);
            z-index: 0;
        }

        .ambient-1 {
            width: 320px;
            height: 320px;
            background: var(--orange);
            top: -60px;
            left: -60px;
        }

        .ambient-2 {
            width: 400px;
            height: 400px;
            background: var(--gold);
            bottom: -80px;
            right: -80px;
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(200, 149, 108, 0.25);
            border-radius: var(--radius-lg);
            padding: 40px 36px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .logo-wrap {
            margin-bottom: 20px;
            display: inline-block;
            position: relative;
        }

        .logo-img {
            width: 86px;
            height: 86px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(140, 94, 60, 0.25);
            border: 3px solid #FFF8F0;
        }

        .brand-title {
            font-family: 'Baloo 2', 'Fredoka', sans-serif;
            font-size: 2rem;
            color: var(--brown-dark);
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
        }

        .login-sub {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 28px;
        }

        /* Flash Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            text-align: left;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .alert-success {
            background-color: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        /* Form */
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--brown-dark);
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--brown-light);
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid rgba(200, 149, 108, 0.35);
            border-radius: 12px;
            font-size: 0.92rem;
            font-family: inherit;
            background: #FFFDFB;
            color: var(--text-dark);
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(232, 137, 42, 0.18);
            background: #fff;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.9rem;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.84rem;
        }

        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .remember-wrap input {
            accent-color: var(--orange);
            width: 16px;
            height: 16px;
        }

        /* ===== PREMIUM LOGIN BUTTON ===== */
        @keyframes shimmer {
            0%   { transform: translateX(-120%) skewX(-20deg); }
            100% { transform: translateX(220%) skewX(-20deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 6px 20px rgba(232, 137, 42, 0.45), 0 0 0 0 rgba(232, 137, 42, 0.25); }
            50%       { box-shadow: 0 10px 32px rgba(232, 137, 42, 0.60), 0 0 0 8px rgba(232, 137, 42, 0); }
        }

        @keyframes icon-bounce {
            0%, 100% { transform: translateX(0); }
            50%       { transform: translateX(3px); }
        }

        .btn-submit-wrap {
            position: relative;
            margin-top: 4px;
        }

        .btn-submit {
            position: relative;
            width: 100%;
            padding: 15px 20px;
            background: linear-gradient(135deg, #F0962E 0%, #D4781A 45%, #8B5E3C 100%);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            font-family: inherit;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.03em;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
            animation: pulse-glow 2.8s ease-in-out infinite;
        }

        /* Shimmer overlay */
        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(255,255,255,0.35) 50%,
                transparent 100%);
            transform: translateX(-120%) skewX(-20deg);
            animation: shimmer 2.5s ease-in-out infinite;
            pointer-events: none;
        }

        /* Top edge highlight */
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            width: 80%;
            height: 1.5px;
            background: rgba(255, 255, 255, 0.55);
            border-radius: 99px;
            pointer-events: none;
        }

        .btn-submit .btn-icon {
            font-size: 1.05rem;
            transition: transform 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px) scale(1.015);
            box-shadow: 0 14px 36px rgba(232, 137, 42, 0.60), 0 4px 12px rgba(0,0,0,0.15);
            filter: brightness(1.06);
            animation: none;
        }

        .btn-submit:hover .btn-icon {
            animation: icon-bounce 0.5s ease infinite;
        }

        .btn-submit:active {
            transform: translateY(-1px) scale(0.99);
            box-shadow: 0 6px 18px rgba(232, 137, 42, 0.45);
            filter: brightness(0.97);
        }



        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 20px;
            font-size: 0.85rem;
            color: var(--brown-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--orange);
            gap: 9px;
        }
    </style>
</head>
<body>

    <!-- Ambient background glows -->
    <div class="ambient-shape ambient-1"></div>
    <div class="ambient-shape ambient-2"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo-wrap">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Cookies Intan" class="logo-img">
            </div>

            <h1 class="brand-title">Cookies Intan</h1>
            <p class="login-sub">Masuk ke Panel Admin untuk mengelola katalog menu</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Email Administrator</label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email', 'admin@cookiesintan.com') }}" 
                               placeholder="admin@cookiesintan.com" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" 
                               placeholder="Masukkan password" required>
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="form-options">
                    <label class="remember-wrap">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="btn-submit-wrap">
                    <button type="submit" class="btn-submit" id="loginBtn">
                        <i class="fa-solid fa-right-to-bracket btn-icon"></i>
                        <span>Masuk Sekarang</span>
                    </button>
                </div>
            </form>



            <div>
                <a href="{{ route('home') }}" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function() {
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });


    </script>
</body>
</html>
