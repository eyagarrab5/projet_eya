<?php
include '../../controller/ReservationC.php';

session_start();
$reservationC= new ReservationC();
$trajetId=$_GET['id'];
$reservation = new Reservation($_SESSION["iduser"],$trajetId,"","");
$reservationC->addReservation($reservation);
$reservationC->updateNbPlace($trajetId,1);
header("Location:reservationPassager.php?id=$trajetId");
?>