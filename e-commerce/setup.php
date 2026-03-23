<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Pandora's Produce</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Century Gothic', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .setup-container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #272727;
            margin-bottom: 10px;
            font-size: 2rem;
        }
        .subtitle {
            color: #999;
            margin-bottom: 30px;
        }
        .status-message {
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: bold;
        }
        .status-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        button {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-setup {
            background-color: #667eea;
            color: white;
        }
        .btn-setup:hover {
            background-color: #5568d3;
        }
        .btn-home {
            background-color: #28a745;
            color: white;
        }
        .btn-home:hover {
            background-color: #218838;
        }
        .steps {
            margin: 30px 0;
        }
        .step {
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .step-number {
            display: inline-block;
            background: #667eea;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-right: 10px;
            font-weight: bold;
        }
        .step h3 {
            color: #272727;
            margin: 10px 0 5px 40px;
        }
        .step p {
            color: #666;
            margin-left: 40px;
            font-size: 0.9rem;
        }
        .database-output {
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            max-height: 300px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <h1>🛒 Pandora's Produce</h1>
        <p class="subtitle">Database Setup</p>

        <div id="setupStatus"></div>

        <div class="steps" id="stepsContainer" style="display: none;">
            <div class="step">
                <h3><span class="step-number">1</span>Database Connection</h3>
                <p>Checking if MySQL is running...</p>
            </div>
            <div class="step">
                <h3><span class="step-number">2</span>Create Database</h3>
                <p>Creating 'pandora_produce' database...</p>
            </div>
            <div class="step">
                <h3><span class="step-number">3</span>Create Tables</h3>
                <p>Creating database tables...</p>
            </div>
            <div class="step">
                <h3><span class="step-number">4</span>Insert Sample Data</h3>
                <p>Inserting 6 sample products...</p>
            </div>
        </div>

        <div class="database-output" id="dbOutput" style="display: none;"></div>

        <div class="button-group" id="buttonGroup">
            <button class="btn-setup" onclick="setupDatabase()">🚀 Setup Database</button>
        </div>

        <p style="text-align: center; color: #999; font-size: 0.85rem; margin-top: 20px;">
            This will create all necessary database tables and insert sample data.
        </p>
    </div>

    <script>
        function setupDatabase() {
            const btn = document.querySelector('.btn-setup');
            const statusDiv = document.getElementById('setupStatus');
            const stepsContainer = document.getElementById('stepsContainer');
            const dbOutput = document.getElementById('dbOutput');
            
            btn.disabled = true;
            btn.textContent = 'Setting up...';
            stepsContainer.style.display = 'block';
            dbOutput.style.display = 'block';
            dbOutput.innerHTML = 'Initializing database setup...\n';

            fetch('init-database.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusDiv.innerHTML = `
                            <div class="status-message status-success">
                                ✓ Database setup completed successfully!
                            </div>
                        `;
                        dbOutput.innerHTML += data.output || '';
                        
                        // Show button to go to home
                        document.getElementById('buttonGroup').innerHTML = `
                            <button class="btn-home" onclick="window.location.href='index.php'">✓ Go to Store</button>
                            <button class="btn-home" onclick="window.location.href='admin.php'" style="background-color: #ff6b9d;">📋 View Admin</button>
                        `;
                    } else {
                        statusDiv.innerHTML = `
                            <div class="status-message status-error">
                                ✗ Error: ${data.message}
                            </div>
                        `;
                        dbOutput.innerHTML += (data.output || '') + '\n\nError: ' + data.message;
                        btn.disabled = false;
                        btn.textContent = '🔄 Try Again';
                    }
                })
                .catch(error => {
                    statusDiv.innerHTML = `
                        <div class="status-message status-error">
                            ✗ Error: ${error.message}
                        </div>
                    `;
                    dbOutput.innerHTML += '\n\nError: ' + error.message;
                    btn.disabled = false;
                    btn.textContent = '🔄 Try Again';
                });
        }

        // Check if database is already set up
        function checkDatabase() {
            fetch('init-database.php?check=1')
                .then(response => response.json())
                .then(data => {
                    const statusDiv = document.getElementById('setupStatus');
                    if (data.dbExists) {
                        statusDiv.innerHTML = `
                            <div class="status-message status-success">
                                ✓ Database already exists! You're all set.
                            </div>
                        `;
                        document.getElementById('buttonGroup').innerHTML = `
                            <button class="btn-home" onclick="window.location.href='index.php'">✓ Go to Store</button>
                            <button class="btn-home" onclick="window.location.href='admin.php'" style="background-color: #ff6b9d;">📋 View Admin</button>
                        `;
                    } else {
                        statusDiv.innerHTML = `
                            <div class="status-message status-info">
                                ℹ Database not found. Click below to set up.
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Check database on page load
        document.addEventListener('DOMContentLoaded', checkDatabase);
    </script>
</body>
</html>
