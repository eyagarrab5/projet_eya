<?php

include '../../controller/UserC.php';
include '../../controller/ReservationC.php';

$UserC = new UserC();
$reservationC= new ReservationC();
session_start();
$id= $_SESSION["iduser"];
$user=$UserC->findUserById($id);
$list=$reservationC->JoinReservationTrajet($_GET['id']);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    margin-top: 50px;
    font-family: 'Jost', sans-serif;
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
    color: #fff;
    min-height: 100vh;
    
}
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }
      
.container h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #573b8a;
    font-family: 'Jost', sans-serif;
}
.container a {
    margin-bottom: 20px;
    font-size: 24px;
    color: #573b8a;
    font-family: 'Jost', sans-serif;

}
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #573b8a;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>

</head>
<body>

    <div class="container">
    <a href="trajetConducteur.php">Back</a>
        <h2>List Reservation</h2>

        <table>
            <thead>
                <tr>
                    <th>user_id</th>
                    <th>reservation_date</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
               
                <?php
                if($list){
                 foreach ($list as $reservation){
                  ?>
                <tr>
                    <td><?php echo $reservation['user_id']; ?></td>
                    <td><?php echo $reservation['reservation_date']; ?></td>
                    <td><?php echo $reservation['status']; ?></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</body>
</html>
