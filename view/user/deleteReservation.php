<?php
include '../../controller/ReservationC.php';

session_start();
$reservationC= new ReservationC();
$trajetId=$_GET['idTrajet'];
$reservationId=$_GET['idReservation'];
$reservation=$reservationC->findReservationById($reservationId);
$oldStatus=$reservation['status'];
$reservationC->deleteReservation($reservationId);
if($oldStatus!="Annule"){
$reservationC->updateNbPlace($trajetId,-1);}
header("location: reservationPassager.php?id=$trajetId");


?>