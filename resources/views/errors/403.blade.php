<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Poppins', sans-serif;
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
        
        .error-container {
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 4rem 3rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .error-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #dc2626, #ef4444, #dc2626);
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .error-icon {
            font-size: 4rem;
            color: #dc2626;
            margin-bottom: 2rem;
            opacity: 0.8;
        }
        
        .error-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }
        
        .error-message {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }
        
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 0.875rem 2rem;
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 0;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: #1a1a2e;
            color: white;
            border: 1px solid #1a1a2e;
        }
        
        .btn-primary:hover {
            background: #16213e;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(26, 26, 46, 0.2);
        }
        
        .btn-secondary {
            background: transparent;
            color: #1a1a2e;
            border: 1px solid #e5e7eb;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #1a1a2e;
        }
        
        @media (max-width: 480px) {
            .error-container {
                padding: 3rem 2rem;
            }
            
            .error-code {
                font-size: 6rem;
            }
            
            .error-icon {
                font-size: 3rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .error-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="error-code">403</div>
        <h1 class="error-title">Access Forbidden</h1>
        <p class="error-message">
            You don't have permission to access this resource. 
            If you believe this is an error, please contact the administrator.
        </p>
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <i class="fa-solid fa-house"></i>
                Go Home
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                Go Back
            </a>
        </div>
    </div>
</body>
</html>
