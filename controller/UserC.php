<?php

include_once __DIR__ . '/../config.php'; // Ensures correct directory traversal
include_once __DIR__ . '/../model/User.php'; // 

class UserC
{


    function login($email,$password)
    {
        $sql = "SELECT * FROM users WHERE email = :email and password = SHA2(:pass, 256)";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':email', $email);
        $req->bindValue(':pass', $password);
        
        try {
            $req->execute();
            $user = $req->fetch();
            if ($user) {
                return $user;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }

    function findUserById($id){
        $sql="SELECT * from users where id=$id";
        $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
    $query->execute();
    $user=$query->fetch();
    return $user;
    }catch (Exception $e){
        $e->getMessage();}
    }


    function addUser(User $user){

        $sql = "INSERT INTO users (firstName,lastName,email,password,role) VALUES (:firstName,:lastName,:email,SHA2(:password, 256),:role)";
        $db = config::getConnexion();
       
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'firstName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'password' => $user->getPassword(),
                    'role' => $user->getRole()
                ]);
            } catch (Exception $e) {
                echo "error=:" . $e->getMessage();
                if ($e) {
                    
                    return false;
                }
            }

        
        return true;
    }



    public function deleteUser($id){
        $sql="DELETE FROM users WHERE id =:id";
        $db=config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
      }
    

    
function updateUser($id,User $user){
    try{
     $db = config::getConnexion();
$query = $db->prepare("UPDATE users SET  firstName = :firstName , lastName = :lastName , role = :role WHERE id =$id ");
$query->execute([
       
         'firstName'=> $user->getFirstName(),
         'lastName'=> $user->getLastName(),
         'role'=> $user->getRole()
]);
 } catch (Exception $e){
     $e->getMessage();
}}


public function getAll(){
     
    $sql="SELECT * from users ";
    $db = config::getConnexion();
   try{
       $query = $db->prepare($sql);
   $query->execute();
   $list=$query->fetchAll();
   return $list;
   }catch (Exception $e){
       $e->getMessage();}
}




public static function getRoleStatistics()
{
    $db = config::getConnexion();
    $sql = "SELECT role, COUNT(*) AS count FROM users GROUP BY role";
    try {
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $roleCounts = [];
        foreach ($result as $row) {
            $roleCounts[$row['role']] = $row['count'];
        }
        return $roleCounts;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


public static function getTopUsers()
{
    $db = config::getConnexion();
    $sql = "
        SELECT u.id, u.firstName, u.lastName, COUNT(t.id) AS trajectCount
        FROM users u
        JOIN trajet t ON u.id = t.conductuer_id 
        GROUP BY u.id
        ORDER BY trajectCount DESC
        LIMIT 5
    ";
    try {
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}




public function searchUsers($value) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM users WHERE 
            firstName LIKE :value OR 
            lastName LIKE :value OR 
            email LIKE :value";
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':value', '%' . $value . '%');
        $query->execute();
        $list = $query->fetchAll();
        return $list;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

public function getAllUsersSortedBy($column) {
    $allowedColumns = ['firstName', 'lastName', 'email'];
    if (!in_array($column, $allowedColumns)) {
        $column = 'firstName'; // Default sorting column
    }
    $sql = "SELECT * FROM users ORDER BY " . $column;
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



}
?>