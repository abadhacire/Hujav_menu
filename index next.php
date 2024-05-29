<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('OIP (13).jpg') center/cover;
            color: white;
            font: 16px Arial, sans-serif;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-option {
            width: 70px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .login-option:hover {
            transform: translateY(-5px);
        }

        .login-option img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .login-option p {
            margin: 0;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-option">
            <a href="index1.php">
                <img src="OIP.jfif" alt="Kitchen Staff">
                <p>Kitchen Staff Login</p>
            </a>
        </div>
        </body>
</html>
