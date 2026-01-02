<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #fafafa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(26, 26, 46, 0.015) 40px, rgba(26, 26, 46, 0.015) 41px),
                repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(26, 26, 46, 0.015) 40px, rgba(26, 26, 46, 0.015) 41px),
                repeating-linear-gradient(45deg, transparent, transparent 80px, rgba(26, 26, 46, 0.008) 80px, rgba(26, 26, 46, 0.008) 81px);
            opacity: 1;
            z-index: 0;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(30deg, rgba(26, 26, 46, 0.02) 12%, transparent 12.5%, transparent 87%, rgba(26, 26, 46, 0.02) 87.5%, rgba(26, 26, 46, 0.02)),
                linear-gradient(150deg, rgba(26, 26, 46, 0.02) 12%, transparent 12.5%, transparent 87%, rgba(26, 26, 46, 0.02) 87.5%, rgba(26, 26, 46, 0.02)),
                linear-gradient(30deg, rgba(26, 26, 46, 0.02) 12%, transparent 12.5%, transparent 87%, rgba(26, 26, 46, 0.02) 87.5%, rgba(26, 26, 46, 0.02)),
                linear-gradient(150deg, rgba(26, 26, 46, 0.02) 12%, transparent 12.5%, transparent 87%, rgba(26, 26, 46, 0.02) 87.5%, rgba(26, 26, 46, 0.02));
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px;
            z-index: 0;
            pointer-events: none;
        }
        .login-container {
            background: white;
            padding: 3rem 2.5rem;
            border-radius: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            max-width: 420px;
            width: 100%;
            border: 1px solid #e5e7eb;
            position: relative;
            z-index: 1;
        }
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1a1a2e, #16213e, #1a1a2e);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }
        .login-header::before {
            content: '\f3ed';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 2.5rem;
            color: #1a1a2e;
            display: block;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        .login-header h1 {
            color: #1a1a2e;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.02em;
        }
        .login-header p {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 400;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-group label i {
            color: #6b7280;
            font-size: 0.875rem;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.875rem;
        }
        .form-group input {
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background: white;
            width: 100%;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1a1a2e;
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.05);
        }
        .login-btn {
            padding: 0.875rem;
            background: #1a1a2e;
            color: white;
            border: none;
            border-radius: 0;
            font-size: 0.9375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .login-btn:hover {
            background: #16213e;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(26, 26, 46, 0.2);
        }
        .login-btn:active {
            transform: translateY(0);
        }
        .error-message {
            background: #fef2f2;
            color: #991b1b;
            padding: 0.75rem 1rem;
            border-radius: 0;
            border: 1px solid #fecaca;
            display: none;
            font-size: 0.875rem;
            text-align: center;
        }
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Login</h1>
            <p>Testimonials Management</p>
        </div>

        @if ($errors->any())
            <div class="error-message" style="display: block;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-at input-icon"></i>
                    <input type="email" id="email" name="email" placeholder="admin@michelojustus.com" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-key input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>
            </div>
            <button type="submit" class="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
