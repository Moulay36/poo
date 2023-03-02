<?php

class Assure
{

    // 1 - déclaration des propriétés (attributs)
    private $nom = 'Jules';
    private $age = '34';
    private $domicile = 'Paris';
    private $bonusMalus = 0;

    // 2 - définir les méthodes

    public function reglerAssurance()
    {
        //     $this->bonusMalus = $this->bonusMalus + 4;
        $this->setBonusMalus(4);
    }

    public function avoirAccident()
    {
        $this->setBonusMalus(-14);

    }

    public function parrainer(Assure $parraine)
    {

        if ($this->getBonusMalus() >= 10) {

            $parraine->setBonusMalus(10);
        } else {

            $parraine->setBonusMalus(4);
        }

    }


//LES SETTERS

    public function setNom($nom)
    {

        if (empty($nom) || ctype_space($nom)) {
            trigger_error("Vous devez saisir un nom.", E_USER_WARNING);
            return;
        }

        $this->nom = $nom;

    }

    public function setAge($age)
    {

        if (empty($age) || ($age < 0 || $age > 128)) {
            trigger_error("L'age est une valeur entière comprise entre 0 et 128 ans.", E_USER_WARNING);
            return;
        }

        $this->age = $age;

    }

    public function setDomicile($domicile)
    {

        if (empty($domicile) || ctype_space($domicile)) {
            trigger_error("Vous devez saisir un domicile.", E_USER_WARNING);
            return;
        }

        $this->domicile = $domicile;

    }


    public function setBonusMalus($bonusMalus)
    {

        if (empty($bonusMalus) || ctype_space(strval($bonusMalus))) {
            trigger_error("Vous devez saisir la valeur du bonus ou du malus.", E_USER_WARNING);
            return;
        }

        if (($this->getBonusmalus() + $bonusMalus) <= -50) {

            $this->bonusMalus = -50;

        } elseif (($this->getBonusMalus() + $bonusMalus) >= 50) {

            $this->bonusMalus = 50;

        } else {

            $this->bonusMalus = $this->getBonusMalus() + $bonusMalus;

        }

    }

//LES GETTERS
    public
    function getBonusMalus()
    {

        return $this->bonusMalus;
    }

    public
    function getNom()
    {

        return $this->nom;
    }

    public
    function getAge()
    {

        return $this->age;
    }

    public
    function getDomicile()
    {

        return $this->domicile;
    }
}
