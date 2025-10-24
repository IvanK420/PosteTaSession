<?php

class Session
{
    private $id;
    private $idPecheur;
    private $date;
    private $prise;
    private $poids;
    private $spot;


    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIdPecheur()
    {
        return $this->idPecheur;
    }

    /**
     * @param mixed $idPecheur
     */
    public function setIdPecheur($idPecheur)
    {
        $this->idPecheur = $idPecheur;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPrise()
    {
        return $this->prise;
    }

    /**
     * @param mixed $prise
     */
    public function setPrise($prise)
    {
        $this->prise = $prise;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return mixed
     */
    public function getSpot()
    {
        return $this->spot;
    }

    /**
     * @param mixed $spot
     */
    public function setSpot($spot)
    {
        $this->spot = $spot;
    }

}