<?php

include '../controller/UserC.php';


$UserC = new UserC();

        if (
            isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
            isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]) &&
            isset($_POST["role"]) && !empty($_POST["role"])
        ) {
	$user = new User($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["password"],$_POST["role"]);
    $UserC->addUser($user);
    header('Location: login.php');
	}
    

    
    
    ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            width: 500px;
            background: url("https://via.placeholder.com/350x500") no-repeat center/cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
            overflow: hidden;
            position: relative;
        }
        .signup {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 20px;
            background: #eee;
            border-radius: 10px;
            box-sizing: border-box;
            overflow-y: auto;
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
            width: 80%;
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
        select {
    margin-left: 35px;
    width: 85%;
    padding: 10px;
    border: 2px solid #573b8a;
    border-radius: 5px;
    background-color: #eee;
    color: #573b8a;
    font-size: 1em;
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: border-color 0.3s, box-shadow 0.3s;
}

select:focus {
    outline: none;
    border-color: #6d44b8;
    box-shadow: 0 0 10px rgba(109, 68, 184, 0.2);
}

option {
    padding: 10px;
    background-color: #fff;
    color: #573b8a;
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
        <div class="signup">
        <form method="POST" id="signUpForm">
        <label>Sign Up</label>
        <input type="text" name="firstname" id="firstname" placeholder="First Name">
        <span class="error" id="errorFirstname"></span>

        <input type="text" name="lastname" id="lastname" placeholder="Last Name">
        <span class="error" id="errorLastname"></span>

        <input type="email" name="email" id="email" placeholder="Email">
        <span class="error" id="errorEmail"></span>

        <input type="password" name="password" id="password" placeholder="Password">
        <span class="error" id="errorPassword"></span>

        <select name="role" id="role">
            <option value="Conducteur">Conducteur</option>
            <option value="Passager">Passager</option>
        </select>
        <span class="error" id="errorRole"></span>

        <button type="submit">Sign Up</button>
    </form>
            <a href="login.php" style="text-align: center; display: block; color: #573b8a; margin-top: 10px;">Login</a>
        </div>
    </div>
</body>

<script>
        document.getElementById('signUpForm').addEventListener('submit', function(event) {
            // Initialize form validity flag
            let isValid = true;

            // Validate First Name
            let firstname = document.getElementById('firstname');
            let errorFirstname = document.getElementById('errorFirstname');
            if (firstname.value.trim() === '') {
                errorFirstname.textContent = 'First name is required.';
                isValid = false;
            } else {
                errorFirstname.textContent = '';
            }

            // Validate Last Name
            let lastname = document.getElementById('lastname');
            let errorLastname = document.getElementById('errorLastname');
            if (lastname.value.trim() === '') {
                errorLastname.textContent = 'Last name is required.';
                isValid = false;
            } else {
                errorLastname.textContent = '';
            }

            // Validate Email
            let email = document.getElementById('email');
            let errorEmail = document.getElementById('errorEmail');
            if (email.value.trim() === '') {
                errorEmail.textContent = 'Email is required.';
                isValid = false;
            } else {
                errorEmail.textContent = '';
            }

            // Validate Password
            let password = document.getElementById('password');
            let errorPassword = document.getElementById('errorPassword');
            if (password.value.trim() === '') {
                errorPassword.textContent = 'Password is required.';
                isValid = false;
            } else {
                errorPassword.textContent = '';
            }

            // Validate Role
            let role = document.getElementById('role');
            let errorRole = document.getElementById('errorRole');
            if (role.value.trim() === '') {
                errorRole.textContent = 'Role is required.';
                isValid = false;
            } else {
                errorRole.textContent = '';
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</html>