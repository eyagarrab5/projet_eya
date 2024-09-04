<?php

include_once __DIR__ . '/../config.php'; // Ensures correct directory traversal
include_once __DIR__ . '/../model/Reservation.php'; // 

class ReservationC
{


    function JoinReservationTrajet($id) {
        $sql = "SELECT * FROM reservation 
                JOIN trajet ON reservation.trajet_id = trajet.id 
                WHERE reservation.trajet_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([':id' => $id]);
            $liste = $query->fetchAll();
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function addReservation(Reservation $reservation) {
        $sql = "INSERT INTO reservation (user_id,trajet_id) VALUES (:user_id,:trajet_id)";
        $db = config::getConnexion();
       
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    ':user_id' => $reservation->getUserId(),
                    ':trajet_id' => $reservation->getTrajetId()
                    
                ]);
            } catch (Exception $e) {
                echo "error=:" . $e->getMessage();
                if ($e) {
                    //echo "nope bro";
                    return false;
                }
            }
 
        
        return true;
    }
 


    

  public function deleteReservation($id){
    $sql="DELETE FROM reservation WHERE id_Reservation =:id";
    $db=config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    
    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }






  function findReservationById($id){
    $sql="SELECT * from reservation where id_Reservation=$id";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$user=$query->fetch();
return $user;
}catch (Exception $e){
    $e->getMessage();}
}



function updateReservation($id,Reservation $reservation){
    try{
     $db = config::getConnexion();
$query = $db->prepare("UPDATE reservation SET  reservation_date = :reservation_date , status = :status WHERE id_Reservation =$id ");
$query->execute([
         'reservation_date'=> $reservation->getReservationDate(),
         'status'=> $reservation->getStatus()
]);
 } catch (Exception $e){
     $e->getMessage();
}}



function countConfirmedReservations($trajetId) {
    $db = config::getConnexion();

    try {
        $sqlCount = "SELECT COUNT(*) as confirmed_count FROM reservation WHERE trajet_id = :trajet_id AND status = 'Confirme'";
        $queryCount = $db->prepare($sqlCount);
        $queryCount->execute([':trajet_id' => $trajetId]);
        $result = $queryCount->fetch();
        return $result['confirmed_count'];
    } catch (Exception $e) {
        echo "error=:" . $e->getMessage();
        return 0;
    }
}

function updateNbPlace($trajetId, $change) {
    $db = config::getConnexion();

    try {
        $sqlUpdate = "UPDATE trajet SET nb_place = nb_place - :change WHERE id = :trajet_id";
        $queryUpdate = $db->prepare($sqlUpdate);
        $queryUpdate->execute([
            ':change' => $change,
            ':trajet_id' => $trajetId
        ]);
        return true;
    } catch (Exception $e) {
        echo "error=:" . $e->getMessage();
        return false;
    }
}


}
?>