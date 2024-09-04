
<?php

include '../controller/UserC.php';


$UserC = new UserC();

if (
	isset($_POST["email"]) &&
	isset($_POST["pswd"])
  ) {
	if (
	  !empty($_POST['email']) &&
	  !empty($_POST["pswd"])
	) {

$user=$UserC->login($_POST["email"],$_POST["pswd"]);
if($user){
	session_start();
	session_unset(); 
	$_SESSION["iduser"] = $user['id'];
	if($user['role']=="Admin")
	header('Location: admin/users.php');
	else if($user['role']=="Passager")
	header('Location: user/trajetPassager.php');
	else if($user['role']=="Conducteur")
	header('Location: user/trajetConducteur.php');

}

	}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        }
        .main {
            width: 350px;
            height: 500px;
            background: url("https://via.placeholder.com/350x500") no-repeat center/cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
            overflow: hidden;
            position: relative;
        }
        .login {
            position: relative;
            width: 100%;
            height: 100%;
            background: #eee;
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }
        label {
            color: #573b8a;
            font-size: 2.3em;
            display: flex;
            justify-content: center;
            margin: 60px;
            font-weight: bold;
        }
        input {
            width: 60%;
            height: 20px;
            background: #e0dede;
            justify-content: center;
            display: flex;
            margin: 20px auto;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
        button {
            width: 60%;
            height: 40px;
            margin: 10px auto;
            display: block;
            color: #fff;
            background: #573b8a;
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: .2s ease-in;
        }
        button:hover {
            background: #6d44b8;
        }
		.error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="login">
		<form method="POST" id="loginForm">
        <label>Login</label>
        <input type="text" name="email" id="email" placeholder="Username">
        <span class="error" id="errorEmail"></span>

        <input type="password" name="pswd" id="pswd" placeholder="Password">
        <span class="error" id="errorPassword"></span>

        <button type="submit">Login</button>
    </form>
            <a href="signup.php" style="text-align: center; display: block; color: #573b8a; margin-top: 10px;">Sign Up</a>
        </div>
    </div>
</body>
<script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            // Initialize form validity flag
            let isValid = true;

            // Validate Email/Username
            let email = document.getElementById('email');
            let errorEmail = document.getElementById('errorEmail');
            if (email.value.trim() === '') {
                errorEmail.textContent = 'Username is required.';
                isValid = false;
            } else {
                errorEmail.textContent = '';
            }

            // Validate Password
            let pswd = document.getElementById('pswd');
            let errorPassword = document.getElementById('errorPassword');
            if (pswd.value.trim() === '') {
                errorPassword.textContent = 'Password is required.';
                isValid = false;
            } else {
                errorPassword.textContent = '';
            }

            // If the form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</html>
