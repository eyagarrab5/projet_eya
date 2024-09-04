<?php

include '../../controller/UserC.php';
include '../../controller/ReservationC.php';

$UserC = new UserC();
$reservationC= new ReservationC();
session_start();
$id= $_SESSION["iduser"];
$IdTrajet=$_GET['idTrajet'];
$idReservation=$_GET['idReservation'];
if (
    isset($_POST["reservation_date"]) && !empty($_POST["reservation_date"]) &&
    isset($_POST["status"]) && !empty($_POST["status"]) 
) {

$reservation = new Reservation($id,$IdTrajet,$_POST["reservation_date"],$_POST["status"]);
$reservationC->updateReservation($idReservation,$reservation);
if($oldStatus!=$_POST["status"]){
    if($_POST["status"]=='Confirme')
    $reservationC->updateNbPlace($IdTrajet,1);
        else
    $reservationC->updateNbPlace($IdTrajet,-1);
}

header("location: reservationPassager.php?id=$IdTrajet"); 

}
$reservation=$reservationC->findReservationById($idReservation);
$oldStatus=$reservation['status'];

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <style>
        body {
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #573b8a;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #6d44b8;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            color: #fff;
            text-decoration: none;
            font-size: 0.9em;
            background-color: #302b63;
            padding: 10px 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="reservationPassager.php?id=<?php echo $IdTrajet;?>" class="back-link">Back</a>
        <h2>Update Reservation</h2>
        <form method="post" id="reservationForm">
        <label for="reservation_date">Reservation Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" value="<?php echo $reservation['reservation_date']; ?>">
        <span class="error" id="errorReservationDate"></span>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Confirme" <?php if ($reservation['status'] === 'Confirme') echo 'selected'; ?>>Confirme</option>
            <option value="Annule" <?php if ($reservation['status'] === 'Annule') echo 'selected'; ?>>Annule</option>
        </select>
        <span class="error" id="errorStatus"></span>

        <button type="submit">Update Reservation</button>
    </form>
    </div>
</body>
<script>
        document.getElementById('reservationForm').addEventListener('submit', function(event) {
            // Initialize form validity flag
            let isValid = true;

            // Validate Reservation Date
            let reservationDate = document.getElementById('reservation_date');
            let errorReservationDate = document.getElementById('errorReservationDate');
            if (reservationDate.value.trim() === '') {
                errorReservationDate.textContent = 'Reservation date is required.';
                isValid = false;
            } else {
                errorReservationDate.textContent = '';
            }

            // Validate Status
            let status = document.getElementById('status');
            let errorStatus = document.getElementById('errorStatus');
            if (status.value.trim() === '') {
                errorStatus.textContent = 'Status is required.';
                isValid = false;
            } else {
                errorStatus.textContent = '';
            }

            // If the form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</html>
