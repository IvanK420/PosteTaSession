<?php

class Pecheur
{
    private $pseudo;
    private $techniques;
    private $secteur;

    /**
     * @param $pseudo
     * @param $techniques
     * @param $secteur
     */
    public function __construct($pseudo, $techniques, $secteur)
    {
        $this->pseudo = $pseudo;
        $this->techniques = $techniques;
        $this->secteur = $secteur;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getTechniques()
    {
        return $this->techniques;
    }

    /**
     * @param mixed $techniques
     */
    public function setTechniques($techniques)
    {
        $this->techniques = $techniques;
    }

    /**
     * @return mixed
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * @param mixed $secteur
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;
    }


}
