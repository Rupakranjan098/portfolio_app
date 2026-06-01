<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.45);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-color: #f8fafc;
            --text-muted: #94a3b8;
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --input-bg: rgba(15, 23, 42, 0.6);
            --input-border: rgba(255, 255, 255, 0.1);
            --input-focus: rgba(99, 102, 241, 0.5);
            --error-bg: rgba(239, 68, 68, 0.15);
            --error-border: rgba(239, 68, 68, 0.3);
            --error-text: #fca5a5;
            --success-bg: rgba(34, 197, 94, 0.15);
            --success-border: rgba(34, 197, 94, 0.3);
            --success-text: #86efac;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgb(4, 21, 45) 0%, rgb(15, 7, 27) 90.1%);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative glowing circles in background */
        .circle-bg {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 1;
            opacity: 0.5;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: var(--primary-color);
            top: -50px;
            right: -50px;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background: #8b5cf6;
            bottom: -100px;
            left: -100px;
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        .card-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), #8b5cf6);
            border-radius: 16px;
            font-size: 28px;
            color: #fff;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            animation: pulse 2s infinite;
        }

        .card-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .card-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }

        .alert-danger {
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
        }

        .alert-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 13px 40px 13px 40px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--input-focus);
            background: rgba(15, 23, 42, 0.8);
        }

        .form-control:focus + .input-icon {
            color: var(--primary-color);
        }

        .btn-toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 16px;
            outline: none;
            transition: color 0.3s;
        }

        .btn-toggle-password:hover {
            color: var(--text-color);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
            user-select: none;
        }

        .checkbox-container input {
            cursor: pointer;
            accent-color: var(--primary-color);
            width: 16px;
            height: 16px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-password:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color), #8b5cf6);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
            background: linear-gradient(135deg, var(--primary-hover), #7c3aed);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: var(--text-muted);
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link a:hover {
            color: var(--text-color);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }
    </style>
</head>
<body>
    <div class="circle-bg circle-1"></div>
    <div class="circle-bg circle-2"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="card-header">
                <div class="logo-icon"><i class="fa-solid fa-gauge-high"></i></div>
                <h2>Welcome Back</h2>
                <p>Sign in to access your admin panel</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-group">
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autocomplete="email" autofocus>
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <input class="form-control" type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <button type="button" class="btn-toggle-password" id="togglePassword">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>

            <div class="back-link">
                <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left-long"></i> Back to website</a>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = togglePassword.querySelector('i');
            if (type === 'text') {
                icon.className = 'fa-regular fa-eye-slash';
            } else {
                icon.className = 'fa-regular fa-eye';
            }
        });
    </script>
</body>
</html>
