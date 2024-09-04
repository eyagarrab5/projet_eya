<?php

include '../../controller/UserC.php';
$userC = new UserC();
$userC->deleteUser($_GET["id"]);
header('Location:users.php');


?>