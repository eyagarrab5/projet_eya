<?php

include '../../controller/UserC.php';
$UserC = new UserC();
$idUser=$_GET['id'];

if (
    isset($_POST["role"]) && !empty($_POST["role"]) &&
    isset($_POST["lastName"]) && !empty($_POST["lastName"]) &&
    isset($_POST["firstName"]) && !empty($_POST["firstName"])
   
) {
$user = new User($_POST["firstName"],$_POST["lastName"],"","",$_POST["role"]);
$UserC->updateUser($idUser,$user);
header("location: users.php"); 
}
$user=$UserC->findUserById($idUser);


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            padding: 10px;
            background-color: #4CAF50; /* Green */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            display: inline-block;
            padding: 8px 16px;
            margin-bottom: 20px;
            background-color: #2196F3; /* Blue */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .back-link:hover {
            background-color: #1976D2;
        }
      
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    
    </style>
</head>
<body>
    <div class="container">
        <a href="users.php" class="back-link">Back to Users List</a>
        <h1>Update User</h1>
        <form  method="POST" id="myForm">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $user['firstName']; ?>" >
            <span class="error" id="errorFirstName"></span>
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $user['lastName']; ?>" >
            <span class="error" id="errorLastName"></span>
            <label for="role">Role</label>
            <select id="role" name="role" >
                <option value="Admin" <?php echo $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="Conducteur" <?php echo $user['role'] == 'Conducteur' ? 'selected' : ''; ?>>Conducteur</option>
                <option value="Passager" <?php echo $user['role'] == 'Passager' ? 'selected' : ''; ?>>Passager</option>
            </select>
            <span class="error" id="errorRole"></span>

            <button type="submit">Update User</button>
        </form>
    </div>
</body>

<script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            // Flag to determine if the form is valid
            let isValid = true;

            // Validate First Name
            let firstName = document.getElementById('firstName');
            let errorFirstName = document.getElementById('errorFirstName');
            if (firstName.value.trim() === '') {
                errorFirstName.textContent = 'First Name is required.';
                isValid = false;
            } else {
                errorFirstName.textContent = '';
            }

            // Validate Last Name
            let lastName = document.getElementById('lastName');
            let errorLastName = document.getElementById('errorLastName');
            if (lastName.value.trim() === '') {
                errorLastName.textContent = 'Last Name is required.';
                isValid = false;
            } else {
                errorLastName.textContent = '';
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

            // If the form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</html>
