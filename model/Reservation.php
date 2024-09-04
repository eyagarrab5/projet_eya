<?php

class Reservation
{
    private $id;
    private $user_id;
    private $trajet_id;
    private $reservation_date;
    private $status;
   

    public function __construct($user_id,$trajet_id,$reservation_date,$status)
    {
        $this->user_id = $user_id;
        $this->trajet_id = $trajet_id;
        $this->reservation_date = $reservation_date;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getTrajetId()
    {
        return $this->trajet_id;
    }

    public function setTrajetId($trajet_id)
    {
        $this->trajet_id = $trajet_id;
    }

    public function getReservationDate()
    {
        return $this->reservation_date;
    }

    public function setReservationDate($reservation_date)
    {
        $this->reservation_date = $reservation_date;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


}
?>