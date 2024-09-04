<?php

include '../../controller/TrajetC.php';
$trajetC = new TrajetC();
$trajetC->deleteTrajet($_GET["id"]);
header('Location:trajetConducteur.php');


?>