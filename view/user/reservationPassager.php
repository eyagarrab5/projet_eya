<?php

include '../../controller/UserC.php';
include '../../controller/ReservationC.php';
include '../../controller/TrajetC.php';

$UserC = new UserC();
$reservationC= new ReservationC();
$trajetC= new TrajetC();
session_start();
$id= $_SESSION["iduser"];
$user=$UserC->findUserById($id);
$idTrajet=$_GET['id'];
$list=$reservationC->JoinReservationTrajet($_GET['id']);
$trajet=$trajetC->findTrajetById($idTrajet);
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
            padding: 0;
        }
        .container {
            
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        h2 {
            margin-top: 0;
            color: #573b8a;
        }
        a {
            text-decoration: none;
            color: #573b8a;
            font-weight: bold;
            border: 2px solid #573b8a;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #573b8a;
            color: #fff;
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
        .button-container {
            margin-top: 20px;
        }
        .button-container a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
        .button-container a:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>

    <div class="container">
    <a href="trajetPassager.php">Back</a>
    <?php if($trajet['nb_place']>0){?>
    <div class="button-container">
            <a href="addReservation.php?id=<?php echo $idTrajet;?>">Ajout Reservation</a>
        </div>
        <?php  }?>
        <h2>List Reservation</h2>

        <table>
            <thead>
                <tr>
                    <th>user_id</th>
                    <th>reservation_date</th>
                    <th>status</th>
                    <th>Action</th>
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
                                    <td>
                                    <?php if($reservation['user_id'] == $id) { ?>
                                    <a href="updateReservation.php?idTrajet=<?php echo $idTrajet;?>&idReservation=<?php echo $reservation['id_Reservation']; ?>" style="display: inline-block; padding: 4px 8px; background-color: green; color: #fff;border: none;border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.9em; transition: background-color 0.3s;">Update</a>
                                    <a href="deleteReservation.php?idTrajet=<?php echo $idTrajet;?>&idReservation=<?php echo $reservation['id_Reservation']; ?>" style="display: inline-block; padding: 4px 8px; background-color: red; color: #fff; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.9em; transition: background-color 0.3s;">Delete</a>
                                        <?php } ?>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
