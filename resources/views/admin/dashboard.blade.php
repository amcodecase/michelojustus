<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #fafafa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            padding: 0;
            margin: 0;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .admin-header h1 {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .admin-header h1::before {
            content: '\f3ed';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.5rem;
        }
        .logout-btn {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .admin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .dashboard-card {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 2rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: block;
        }
        .dashboard-card:hover {
            border-color: #1a1a2e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .dashboard-card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1a1a2e;
        }
        .dashboard-card h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.25rem;
            color: #1a1a2e;
        }
        .dashboard-card p {
            margin: 0;
            color: #6b7280;
            font-size: 0.9375rem;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <form method="POST" action="/admin/logout" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

    <div class="admin-content">
        <h2 style="margin-bottom: 1rem; color: #1a1a2e;">Content Management</h2>
        <p style="color: #6b7280; margin-bottom: 2rem;">Manage your website content from here</p>
        
        <div class="dashboard-grid">
            <a href="/admin/testimonials" class="dashboard-card">
                <div class="dashboard-card-icon">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h2>Testimonials</h2>
                <p>Review, approve, and manage client testimonials</p>
            </a>
            
            <a href="/admin/projects" class="dashboard-card">
                <div class="dashboard-card-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <h2>Projects</h2>
                <p>Add, edit, and organize your portfolio projects</p>
            </a>
        </div>
    </div>
</body>
</html>
