<?php

class Session
{
    private $Id;
    private $Idpecheur;
    private $date;
    private $prises;
    private $poids;
    private $spot;

    /**
     * @param $Idpecheur
     * @param $date
     * @param $prises
     * @param $poids
     * @param $spot
     */
    public function __construct($Idpecheur, $date, $prises, $poids, $spot)
    {
        $this->Idpecheur = $Idpecheur;
        $this->date = $date;
        $this->prises = $prises;
        $this->poids = $poids;
        $this->spot = $spot;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }
    public function getIdpecheur()
    {
        return $this->Idpecheur;
    }

    /**
     * @param mixed $Idpecheur
     */
    public function setIdpecheur($Idpecheur)
    {
        $this->Idpecheur = $Idpecheur;
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
    public function getPrises()
    {
        return $this->prises;
    }

    /**
     * @param mixed $prises
     */
    public function setPrises($prises)
    {
        $this->prises = $prises;
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