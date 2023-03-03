<?php

class AssureManager{

    private $cnx;

    public function __construct($cnx){

        $this->setCnx($cnx);
    }

    public function setCnx($cnx){

        $this->cnx = $cnx;
    }

    // Partie CRUD consultation (liste et fiche), ajout,
    // la modification et la suppresion


    public function addAssure(Assure $assure)
    {
        // Requête attendue de type INSERT
        $sql = "INSERT INTO assure (nom, age, domicile, bonusMalus, pointsFidelite) 
                VALUES(?,?,?,?,?)";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([
            $assure->getNom(),
            $assure->getAge(),
            $assure->getDomicile(),
            $assure->getBonusMalus(),
            $assure->getPointsFidelite(),
        ]);
    }

    public function editAssure(Assure $assure){
        // Requête attendue de type UPDATE
        $sql = "UPDATE assure SET nom = ?, age = ?, domicile = ?, bonusMalus = ?, pointsFidelite = ?
                WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([
            $assure->getNom(),
            $assure->getAge(),
            $assure->getDomicile(),
            $assure->getBonusMalus(),
            $assure->getPointsFidelite(),
            $assure->getIdAssure(),
        ]);
    }

    public function deleteAssure(Assure $assure){
        // Requête attendue de type DELETE
        $sql = "DELETE FROM assure WHERE idAssure = ?"; // Requête préparée
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$assure->getIdAssure()]); //Autre possibilité : array($id)


    }

    public function getListAssure(){
        // Requête attendue de type SELECT (Liste des assurés)
        $sql = "SELECT * FROM assure";
        $idRequete = $this->cnx->query($sql); // Requête simple
        while($row = $idRequete->fetch(PDO::FETCH_ASSOC)){

            $assures[] = new Assure($row);
        }

        return $assures;
    }

    public function getAssure($id){
        // Requête attendue de type SELECT (1 seul assuré)
        $sql = "SELECT * FROM assure WHERE idAssure = ?"; // Requête préparée
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$id]); //Autre possibilité : array($id)
        $row = $idRequete->fetch(PDO::FETCH_ASSOC);

        $oAssure = new Assure($row); // return new Assure($row);
        return $oAssure;
    }

    public function count(){
        $sql = "SELECT * FROM assure";
        $r = $this->cnx->query($sql);
        return $r->rowCount();

    }


}