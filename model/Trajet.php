<?php

class Trajet
{
    private $id;
    private $departure;
    private $destination;
    private $date;
    private $price;
    private $conducteur_id;
    private $nb_place;
  

    public function __construct($departure,$destination,$date,$price,$conducteur_id,$nb_place)
    {
        $this->departure = $departure;
        $this->destination = $destination;
        $this->date = $date;
        $this->price = $price;
        $this->conducteur_id = $conducteur_id;
        $this->nb_place = $nb_place;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDeparture()
    {
        return $this->departure;
    }

    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getConducteurId()
    {
        return $this->conducteur_id;
    }

    public function setConducteurId($conducteur_id)
    {
        $this->conducteur_id = $conducteur_id;
    }

    public function getNbPlace()
    {
        return $this->nb_place;
    }

    public function setNbPlace($nb_place)
    {
        $this->nb_place = $nb_place;
    }


}

?>