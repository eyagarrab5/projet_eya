<?php

include_once __DIR__ . '/../config.php'; // Ensures correct directory traversal
include_once __DIR__ . '/../model/Trajet.php'; // 

class TrajetC
{


    public function getAll(){
     
         $sql="SELECT * from trajet ";
         $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        $query->execute();
        $list=$query->fetchAll();
        return $list;
        }catch (Exception $e){
            $e->getMessage();}
    }

    public function findByuser($id){
     
        $sql="SELECT * from trajet where conductuer_id = :id";
        $db = config::getConnexion();
       try{
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $list=$query->fetchAll();
       return $list;
       }catch (Exception $e){
           $e->getMessage();}
   }



   function addtrajet(Trajet $trajet)
   {

       $sql = "INSERT INTO trajet (departure,destination,date,conductuer_id,price,nb_place) VALUES (:departure,:destination,:date,:conductuer_id,:price,:nb_place)";
       $db = config::getConnexion();
      
           try {
               $query = $db->prepare($sql);
               $query->execute([
                   ':departure' => $trajet->getDeparture(),
                   ':destination' => $trajet->getDestination(),
                   ':date' => $trajet->getdate(),
                   ':conductuer_id' => $trajet->getConducteurId(),
                   ':price' => $trajet->getPrice(),
                   ':nb_place' => $trajet->getNbPlace()
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



  public function deleteTrajet($id){
    $sql="DELETE FROM trajet WHERE id =:id";
    $db=config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    
    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }


  function findTrajetById($id){
    $sql="SELECT * from trajet where id=$id";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$user=$query->fetch();
return $user;
}catch (Exception $e){
    $e->getMessage();}
}



function updateTrajet($id,Trajet $trajet){
    try{
     $db = config::getConnexion();
$query = $db->prepare("UPDATE trajet SET  departure = :departure , destination = :destination , date = :date, price = :price, nb_place = :nb_place WHERE id =$id ");
$query->execute([
       
         'departure'=> $trajet->getDeparture(),
         'destination'=> $trajet->getDestination(),
         'date'=> $trajet->getdate(),
         'price'=> $trajet->getPrice(),
         ':nb_place'=> $trajet->getNbPlace()
]);
 } catch (Exception $e){
     $e->getMessage();
}}



public function searchTrajets($value){
     
    $sql = "SELECT * FROM trajet WHERE 
            departure LIKE :value OR 
            destination LIKE :value OR 
            price LIKE :value OR 
            nb_place LIKE :value";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':value', '%' . $value . '%');
   $query->execute();
   $list=$query->fetchAll();
   return $list;
   }catch (Exception $e){
       $e->getMessage();}
}


public function getAllSortedBy($column){
     
    $allowedColumns = ['date', 'price'];
    if (!in_array($column, $allowedColumns)) {
        $column = 'date'; // Default sorting column
    }
    
    $sql = "SELECT * FROM trajet ORDER BY " . $column;
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute();
        $list = $query->fetchAll();
        return $list;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}




public function searchTrajetsbyUser($id,$value){
     
    $sql = "SELECT * FROM trajet WHERE 
            departure LIKE :value OR 
            destination LIKE :value OR 
            price LIKE :value OR 
            nb_place LIKE :value AND conductuer_id = :id ";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':value', '%' . $value . '%');
        $query->bindValue(':id', $id);
   $query->execute();
   $list=$query->fetchAll();
   return $list;
   }catch (Exception $e){
       $e->getMessage();}
}


public function getAllSortedByUser($id,$column){
     
    $allowedColumns = ['date', 'price'];
    if (!in_array($column, $allowedColumns)) {
        $column = 'date'; // Default sorting column
    }
    
    $sql = "SELECT * FROM trajet where  conductuer_id = :id  ORDER BY " . $column;
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $list = $query->fetchAll();
        return $list;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}




}

?>