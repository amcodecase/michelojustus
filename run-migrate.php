<?php
/**
 * Laravel Migration Runner Script
 * 
 * WARNING: This file is for TEMPORARY USE ONLY!
 * DELETE THIS FILE immediately after use for security reasons.
 * 
 * Usage: http://yourdomain.com/run-migrate.php?key=MySecretKey123
 */

// Configuration
define('SECRET_KEY', '@WhiteDiamond0100'); // Change this to a strong, unique key
define('PROJECT_ROOT', __DIR__);

// Check for authorization
if (!isset($_GET['key']) || $_GET['key'] !== SECRET_KEY) {
    http_response_code(403);
    die('
    <!DOCTYPE html>
    <html>
    <head>
        <title>Unauthorized</title>
        <style>
            body { font-family: Arial, sans-serif; padding: 50px; background: #f5f5f5; }
            .error { background: #ff4444; color: white; padding: 20px; border-radius: 8px; }
        </style>
    </head>
    <body>
        <div class="error">
            <h1>⛔ Unauthorized Access</h1>
            <p>Invalid or missing authentication key.</p>
        </div>
    </body>
    </html>
    ');
}

// Change to project root directory
chdir(PROJECT_ROOT);

// HTML Header
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Migration Runner</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            padding: 20px;
            background: #1e293b;
            color: #e2e8f0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #0f172a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #10b981;
            border-bottom: 2px solid #10b981;
            padding-bottom: 10px;
        }
        .warning {
            background: #dc2626;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: bold;
        }
        .info {
            background: #0ea5e9;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .success {
            background: #10b981;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .output {
            background: #1e293b;
            border: 2px solid #334155;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            overflow-x: auto;
        }
        pre {
            margin: 0;
            color: #e2e8f0;
            font-size: 14px;
            line-height: 1.6;
        }
        .timestamp {
            color: #64748b;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Laravel Migration Runner</h1>
        
        <div class="warning">
            ⚠️ WARNING: DELETE THIS FILE IMMEDIATELY AFTER USE!<br>
            This script bypasses normal security measures and should NEVER be left on a production server.
        </div>

        <div class="info">
            <strong>Command:</strong> php artisan migrate:fresh --seed --force<br>
            <strong>Working Directory:</strong> <?php echo htmlspecialchars(PROJECT_ROOT); ?><br>
            <strong>Timestamp:</strong> <span class="timestamp"><?php echo date('Y-m-d H:i:s'); ?></span>
        </div>

        <h2>📋 Command Output:</h2>
        <div class="output">
            <pre><?php

// Execute the migration command
$command = 'php artisan migrate:fresh --seed --force 2>&1';
$output = [];
$returnCode = 0;

exec($command, $output, $returnCode);

// Display output
if (!empty($output)) {
    echo htmlspecialchars(implode("\n", $output));
} else {
    echo "No output received from command.";
}

?></pre>
        </div>

        <?php if ($returnCode === 0): ?>
            <div class="success">
                ✅ <strong>SUCCESS!</strong> Migration completed successfully.<br>
                Exit Code: <?php echo $returnCode; ?>
            </div>
        <?php else: ?>
            <div class="warning">
                ❌ <strong>FAILED!</strong> Migration encountered errors.<br>
                Exit Code: <?php echo $returnCode; ?>
            </div>
        <?php endif; ?>

        <div class="warning" style="margin-top: 30px;">
            <strong>🔥 CRITICAL REMINDER:</strong><br>
            1. Delete this file NOW: <code>rm <?php echo basename(__FILE__); ?></code><br>
            2. Never commit this file to version control<br>
            3. This script has full access to your database
        </div>

        <div class="info">
            <strong>Next Steps:</strong><br>
            • Verify your database migrations were successful<br>
            • Check that seeded data is correct<br>
            • Remove this file from the server<br>
            • Clear any cached routes/config: <code>php artisan optimize:clear</code>
        </div>
    </div>
</body>
</html>
