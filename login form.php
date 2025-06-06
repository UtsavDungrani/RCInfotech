<html>

<head>
    <meta charset="UTF-8">
    <meta name="login form" content="width=device-width, initial-scale=1.0">
    <title>RCInfotech</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Site css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- colors css -->
    <link rel="stylesheet" href="css/colors1.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!-- wow Animation css -->
    <link rel="stylesheet" href="css/animate.css" />
    <!-- revolution slider css -->
    <link rel="stylesheet" type="text/css" href="revolution/css/settings.css" />
    <link rel="stylesheet" type="text/css" href="revolution/css/layers.css" />
    <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/login_register_background.jpg');
            background-repeat: no-repeat;
            background-position: left;
            background-size: cover;
            opacity: var(#333);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            color: #333;
            text-align: center;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        h5 :hover {
            background-color: rgb(127, 127, 255);
            font-color: white;
            !important
        }

        .loader_animation {
            animation: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>LOGIN FORM</h1>
        <form class="login-form" action="your_login_action.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <p class="mb-2">Forgot password?</p>
            <i class="bi bi-eye-slash" id="togglePassword"></i>
            <input type="submit" value="login" class="btn btn-primary btn-lg" href="index.html">
        </form>
        <h5 style="font-size: small; "><br> Not registered? <a href="registration form.html"
                style="font-size: small;">Create an account</a></h5>
    </div>
    <script src="js/security.js"></script>
</body>

</html>