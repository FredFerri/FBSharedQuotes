<?php

class Personnage  {

    private $nom;
    private $degats;

    public function __construct($nom) {
        $this->nom = $nom;
        $this->degats = 0;

        return 'Nouveau personnage du nom de '.$this->nom.' créé !';
    }

    public function getDegats() {
        return $this->degats;
    }

    public function setDegats($degats) {
        $this->degats += $degats;
    }

    public function attaque(Personnage $adversaire) {
        $adversaire->setDegats(5);
    }

};

?>