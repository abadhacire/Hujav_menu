<!DOCTYPE html>
<html>
<head>
    <title>kitchen Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('OIP (13).jpg'); 
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: white; 
            font-family: Arial, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        form {
            background-color: rgba(0, 0, 0, 0.5); 
            padding: 20px;
            border-radius: 10px;
            text-align: center; 
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 200px; 
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff; 
        }

        input[type="submit"] {
            background-color: #4CAF50; 
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049; 
        }

        form li a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
<form method="post" action="received.php">
    <h2>Kitchen Staff</h2>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" pattern="kitchen" title="Please enter the correct username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" pattern="kitchen" title="Please enter the correct password"><br>
    <input type="submit" value="Login">
   <li><a href="index.php">Home</a></li>

</form>
</body>
</html>
