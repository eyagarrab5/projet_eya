<?php

include '../../controller/UserC.php';

$UserC = new UserC();
session_start();
$id= $_SESSION["iduser"];
$user=$UserC->findUserById($id);




$searchValue = isset($_POST['search']) ? $_POST['search'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

if (!empty($searchValue)) {
  $list = $UserC->searchUsers($searchValue);
} else if ($sort === 'firstName' || $sort === 'lastName'  || $sort === 'email') {
  $list = $UserC->getAllUsersSortedBy($sort);
} else {
    $list=$UserC->getAll();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" type="text/css" href="../user/css/bootstrap.css" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f4f4f4;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 5px;
            color: #fff;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }
        .btn-edit {
            background-color: #4CAF50; /* Green */
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336; /* Red */
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .header-container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-bottom: 20px;
        }
        .welcome-message {
            font-size: 1.2em;
            color: #555;
        }
        .logout-btn {
            background-color: #007bff; /* Blue */
            padding: 8px 16px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
        .custom-input {
    width: 100%; /* Full width of the container */
    max-width: 300px; /* Adjust the max-width as needed */
    padding: 8px; /* Padding inside the input */
    border: 1px solid #ccc; /* Border color */
    border-radius: 4px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Shadow for a subtle 3D effect */
    font-size: 14px; /* Font size */
  }
  
    </style>
</head>
<body>
  
    <div class="container">
    <div class="header-container">
            <div class="welcome-message">
                Welcome, <?php echo $user['firstName'] . ' ' . $user['lastName']; ?>!
            </div>
            <a href="../login.php" class="logout-btn">Logout</a>
        </div>
        <a href="stats.php" class="logout-btn">show Statics</a>
        <h1>User List</h1>
        <form id="searchForm" method="POST" action="">
          <div class="row">
              <div class="col-md-2">
                  <input type="text" name="search" placeholder="Search..." class="custom-input" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
              </div>
              
              <div class="col-md-3">
          <select name="sort" class="custom-input">
            <option value="">Sort By</option>
            <option value="firstName" <?php echo isset($_POST['sort']) && $_POST['sort'] === 'firstName' ? 'selected' : ''; ?>>First Name</option>
            <option value="lastName" <?php echo isset($_POST['sort']) && $_POST['sort'] === 'lastName' ? 'selected' : ''; ?>>Last Name</option>
            <option value="email" <?php echo isset($_POST['sort']) && $_POST['sort'] === 'email' ? 'selected' : ''; ?>>Email</option>
          </select>
        </div>
        <div class="col-md-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
      </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $user){
                  ?>
                <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['firstName']; ?></td>
                        <td><?php echo $user['lastName']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="updateUser.php?id=<?php echo $user['id']; ?>" class='btn btn-edit'>Edit</a>
                            <a href="deleteUser.php?id=<?php echo $user['id']; ?>" class='btn btn-delete'>Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
