
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            background-image: url('background4.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            padding: 0;
            background-position: center;
            justify-content: center;
            align-items: center;
           
        }

        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 30px;
            margin-left: 270px;
           justify-content: center;
            margin-bottom: 5%;

        }
        form{
            border: 1px solid black;
            margin-left: 30%;
            margin-top: 10%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 35%;
            height: 60%;
            box-sizing: border-box;
            margin-bottom: 0;
            border: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 0;
           
        }

        button:hover {
            background-color: #45a049;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
        }

        /* Input Fields Styling */
        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        #register-btn{
            margin-top: 0;
            border: none;

        }
    </style>
</head>

<body>
    <h1>FINANCIAL MANAGEMENT SYSTEM </h1>
   
    <form action="login.php" method="POST">
    <h2>Login Form</h2>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Login</button>
    
</form>
<form action="registration.html" id="register-btn">
    <p>Don't have an account ?</p>
<button id="register-btn" type="submit" onclick="registration.html">Register</button>
</form>
</body>

</html>