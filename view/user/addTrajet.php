<?php

include '../../controller/UserC.php';
include '../../controller/TrajetC.php';

$UserC = new UserC();
$trajetC= new TrajetC();
session_start();
$id= $_SESSION["iduser"];
$user=$UserC->findUserById($id);
if (
    isset($_POST["departure"]) && !empty($_POST["departure"]) &&
    isset($_POST["destination"]) && !empty($_POST["destination"]) &&
    isset($_POST["date"]) && !empty($_POST["date"]) &&
    isset($_POST["price"]) && !empty($_POST["price"]) &&
    isset($_POST["nb_place"]) && !empty($_POST["nb_place"])
) {
$trajet = new Trajet($_POST["departure"],$_POST["destination"],$_POST["date"],$_POST["price"],$id,$_POST["nb_place"]);
$trajetC->addtrajet($trajet);
header('location: trajetConducteur.php'); 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Trajet</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        .form-container {
            width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #573b8a;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #573b8a;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #573b8a;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #6d44b8;
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

<div class="form-container">
<a href="trajetConducteur.php" style="padding: 8px 12px;background-color: red;color: #fff;border: none;border-radius: 5px;cursor: pointer;transition: background-color 0.3s; margin-top:10px;">back</a>
    <h2>Add New Trajet</h2>
    <form action="" method="POST" id="trajetForm">
        <div class="form-group">
            <label for="departure">Departure:</label>
            <input type="text" id="departure" name="departure" >
            <span class="error" id="errorDeparture"></span>
        </div>
        <div class="form-group">
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" >
            <span class="error" id="errorDestination"></span>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" >
            <span class="error" id="errorDate"></span>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" >
            <span class="error" id="errorPrice"></span>
        </div>
        <div class="form-group">
            <label for="nb_place">Number of Places:</label>
            <input type="number" id="nb_place" name="nb_place" min="1" >
            <span class="error" id="errorNbPlace"></span>
        </div>
        <button type="submit" class="submit-btn">ajout Trajet</button>
        
    </form>
    
</div>


</body>

<script>
        document.getElementById('trajetForm').addEventListener('submit', function(event) {
            // Initialize form validity flag
            let isValid = true;

            // Validate Departure
            let departure = document.getElementById('departure');
            let errorDeparture = document.getElementById('errorDeparture');
            if (departure.value.trim() === '') {
                errorDeparture.textContent = 'Departure is required.';
                isValid = false;
            } else {
                errorDeparture.textContent = '';
            }

            // Validate Destination
            let destination = document.getElementById('destination');
            let errorDestination = document.getElementById('errorDestination');
            if (destination.value.trim() === '') {
                errorDestination.textContent = 'Destination is required.';
                isValid = false;
            } else {
                errorDestination.textContent = '';
            }

            // Validate Date
            let date = document.getElementById('date');
            let errorDate = document.getElementById('errorDate');
            if (date.value.trim() === '') {
                errorDate.textContent = 'Date is required.';
                isValid = false;
            } else {
                errorDate.textContent = '';
            }

            // Validate Price
            let price = document.getElementById('price');
            let errorPrice = document.getElementById('errorPrice');
            if (price.value.trim() === '') {
                errorPrice.textContent = 'Price is required.';
                isValid = false;
            } else {
                errorPrice.textContent = '';
            }

            // Validate Number of Places
            let nbPlace = document.getElementById('nb_place');
            let errorNbPlace = document.getElementById('errorNbPlace');
            if (nbPlace.value.trim() === '' || parseInt(nbPlace.value) < 1) {
                errorNbPlace.textContent = 'Number of Places must be at least 1.';
                isValid = false;
            } else {
                errorNbPlace.textContent = '';
            }

            // If the form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</html>
