<?php

class Assure
{

    // 1 - déclaration des propriétés (attributs)
    private $idAssure;
    private $age = '34';
    private $domicile = 'Paris';
    private $bonusMalus = 0;
    private $pointsFidelite = 5;

    /* private $pointsFidelite; */

    public static $information = "Tous les avantages de l'assurance .....";

    const BRONZE = 50; // la carte Bronze s'aquière à partir de 50 pts de fidélités

    const ARGENT = 100; // la carte Argent s'aquière à partir de 100 pts de fidélités

    const OR = 150; // la carte OR s'aquière à partir de 150 pts de fidélités

    public function __construct($data){

        $this->hydrater($data);

    }
    public function  hydrater(array $row){
        foreach ($row as $k => $v){

                // concatener nom de la méthode (rubrique) avec "set" => setter  à appeler
            $setter = 'set' . ucfirst($k);
            // fonction method_exists() : 2 paramètres attendus l'objet en cours et le  nom de la méthose
            if(method_exists($this,$setter)){
                //invoquer la méthode (lesetter)
                $this->$setter($v);
            }
        }


    }

    // 2 - définir les méthodes

    public function reglerAssurance()
    {
        //     $this->bonusMalus = $this->bonusMalus + 4;
        $this->setBonusMalus(4);
        $this->setpointsFidelite(10);
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
            $this->setpointsFidelite(5);
            $parraine->setpointsFidelite(5);


    }





//LES SETTERS

    /**
     * @param int $idAssure
     */
    public function setIdAssure($idAssure)
    {
        $this->idAssure = $idAssure;
    }


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

        if ( ctype_space(strval($bonusMalus))) {
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

    public function setpointsFidelite($pointFidelite)
    {

        if (ctype_space(strval($pointFidelite))) {
            trigger_error("Vous devez saisir la valeur du bonus ou du malus.", E_USER_WARNING);
            return;
        }
        $this->pointsFidelite = $this->getpointFidelite() + $pointFidelite;

    }



//LES GETTERS


    /**
     * @return int
     */


    public function getIdAssure()
    {
        return $this->idAssure;
    }


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
    public
    function getpointFidelite(){
        return $this->pointsFidelite;
    }
}
