<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
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
        
        .maintenance-container {
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 650px;
            width: 100%;
            background: white;
            padding: 4rem 3rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .maintenance-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);
        }
        
        .maintenance-icon {
            font-size: 5rem;
            color: #1a1a2e;
            margin-bottom: 2rem;
            opacity: 0.8;
            animation: rotate 3s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .maintenance-title {
            font-size: 2rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }
        
        .maintenance-message {
            font-size: 1.0625rem;
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.7;
        }
        
        .maintenance-details {
            background: #f9fafb;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }
        
        .maintenance-details p {
            color: #374151;
            font-size: 0.9375rem;
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }
        
        .maintenance-details p:last-child {
            margin-bottom: 0;
        }
        
        .maintenance-details strong {
            color: #1a1a2e;
            font-weight: 600;
        }
        
        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1a1a2e, #16213e, #1a1a2e);
            background-size: 200% 100%;
            animation: progress 2s ease-in-out infinite;
        }
        
        @keyframes progress {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }
        
        .contact-info {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .contact-info a {
            color: #1a1a2e;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .contact-info a:hover {
            color: #16213e;
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .maintenance-container {
                padding: 3rem 2rem;
            }
            
            .maintenance-icon {
                font-size: 4rem;
            }
            
            .maintenance-title {
                font-size: 1.5rem;
            }
            
            .maintenance-message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">
            <i class="fa-solid fa-gears"></i>
        </div>
        <h1 class="maintenance-title">We'll Be Right Back</h1>
        <p class="maintenance-message">
            Our site is currently undergoing scheduled maintenance to improve your experience. 
            We appreciate your patience!
        </p>
        
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <div class="maintenance-details">
            <p><strong>What's happening?</strong></p>
            <p>We're performing system updates and improvements to serve you better.</p>
            <p><strong>Expected Duration:</strong> A few minutes</p>
        </div>
        
        <div class="contact-info">
            <p>
                Need urgent assistance? <br>
                Contact us via <a href="https://wa.me/260770822430" target="_blank">WhatsApp</a> 
                or email at <a href="mailto:admin@michelojustus.com">admin@michelojustus.com</a>
            </p>
        </div>
    </div>
</body>
</html>
