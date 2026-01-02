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
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
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
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            top: -250px;
            right: -250px;
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(118, 75, 162, 0.1) 0%, transparent 70%);
            bottom: -200px;
            left: -200px;
            border-radius: 50%;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem 2.5rem;
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            max-width: 420px;
            width: 100%;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(26, 26, 46, 0.3);
        }
        .login-icon i {
            font-size: 2rem;
            color: white;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-header h1 {
            color: #1a1a2e;
            margin-bottom: 0.5rem;
            font-size: 1.875rem;
            font-weight: 700;
        }
        .login-header p {
            color: #6b7280;
            font-size: 0.95rem;
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
            margin-bottom: 0.625rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
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
            font-size: 1.125rem;
        }
        .form-group input {
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1a1a2e;
            box-shadow: 0 0 0 4px rgba(26, 26, 46, 0.08);
        }
        .login-btn {
            padding: 1rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.0625rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(26, 26, 46, 0.3);
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 26, 46, 0.4);
        }
        .login-btn:active {
            transform: translateY(0);
        }
        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            border: 1px solid #fecaca;
            display: none;
            font-size: 0.9rem;
            text-align: center;
        }
        @media (max-width: 480px) {
            .login-container {
                padding: 2.5rem 1.5rem;
            }
            .login-header h1 {
                font-size: 1.625rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        
        <div class="login-header">
            <h1>Admin Portal</h1>
            <p>Testimonials Management System</p>
        </div>

        @if ($errors->any())
            <div class="error-message" style="display: block;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input type="email" id="email" name="email" placeholder="admin@michelojustus.com" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i> Sign In
            </button>
        </form>
    </div>
</body>
</html>
