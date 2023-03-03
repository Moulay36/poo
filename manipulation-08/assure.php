<?php

class Assure {

    // 1 - déclaration des propriétés (attributs)
    private $idAssure;
    private $nom;
    private $age;
    private $domicile;
    private $bonusMalus;

    private $pointsFidelite;

    public static $information = "Tous les avantages de l'assurance ...";

    const BRONZE = 50; // La carte BRONZE s'acquière à partir de 50 pts de fidélité
    const ARGENT = 100; // La carte ARGENT s'acquière à partir de 100 pts de fidélité
    const OR = 150; // La carte OR s'acquière à partir de 150 pts de fidélité

    public function __construct($data) {
        $this->hydrater($data);
    }

    public function hydrater(array $row)
    {
        foreach ($row as $k => $v)
        {
            // Concaténer "nom de la méthode" (rubrique) avec "set" => setter à appeler
            $setter = 'set'.ucfirst($k);
            // Fonction method_exists() : 2 paramètres attendus l'objet en cours et le nom de la méthode
            if (method_exists($this, $setter))
            {
                // Invoquer la méthode (le setter)
                $this->$setter($v);
            }
        }
    }

    // 2 - définir les méthodes

    // LES SETTERS
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
        if (ctype_space(strval($bonusMalus))) {
            trigger_error("Vous devez saisir la valeur du bonus ou du malus.", E_USER_WARNING);
            return;
        }

        if (($this->getBonusMalus() + $bonusMalus) <= -50) {
            $this->bonusMalus = -50;
        } elseif (($this->getBonusMalus() + $bonusMalus) >= 50) {
            $this->bonusMalus = 50;
        } else {
            $this->bonusMalus = $this->getBonusMalus() + $bonusMalus;
        }
    }

    public function setPointsFidelite($pointsFidelite)
    {
        if (ctype_space(strval($pointsFidelite))) {
            trigger_error("Vous devez saisir la valeur des points de fidélité.", E_USER_WARNING);
            return;
        }

        $this->pointsFidelite = $this->getPointsFidelite() + $pointsFidelite;
    }

    // LES GETTERS
    /**
     * @return int
     */
    public function getIdAssure()
    {
        return $this->idAssure;
    }

    public function getNom()
    {

        return $this->nom;
    }

    public function getAge()
    {

        return $this->age;
    }

    public function getDomicile()
    {

        return $this->domicile;
    }

    public function getBonusMalus()
    {

        return $this->bonusMalus;
    }

    public function getPointsFidelite()
    {
        return $this->pointsFidelite;
    }

    public static function getInformation()
    {
        return self::$information;
    }

    public function avoirAccident()
    {
        $this->setBonusMalus(-14);
    }

    public function parrainer(Assure $parraine)
    {
        /*if ($this->getBonusMalus() >= 10) {
            $parraine->setBonusMalus(10);
        } else {
            $parraine->setBonusMalus(4);
        }*/
        $this->setPointsFidelite(5);
        $parraine->setPointsFidelite(5);
    }

    public function reglerAssurance()
    {
        $this->setBonusMalus(4);
        $this->setPointsFidelite(10);
    }
}