<?php

class assureManager{

    private $cnx;

    public function  __construct($cnx){
        $this->setCnx($cnx);
    }

    public function setCnx($cnx){
        $this->cnx=$cnx;

    }

    //partie CRUD consultation (liste et fiche), ajout,
    // la modification et la suppression

    public function addAssure(Assure $assure){
        //Requete attendue de type Insert
        $sql =  "INSERT INTO assure (nom , age, domicile, bonusMalus, pointFidilete) VALUES (?, ?, ?, ?)";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([
            $assure->getNom(),
            $assure->getAge(),
            $assure->getDomicile(),
            $assure->getBonusMalus(),
            $assure->getpointFidelite(),
            $assure->getIdAssure(),
        ]);

    }
    public function ediAssure(Assure $assure){
        //Requete attendue de type UPDATE
        $sql =  "UPDATE assure SET nom = ?, age = ?, domicile =  ?, bonusMalus= ?, pointFidilete = ?, WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([
            $assure->getNom(),
            $assure->getAge(),
            $assure->getDomicile(),
            $assure->getBonusMalus(),
            $assure->getpointFidelite(),
            $assure->getIdAssure(),
        ]);

    }
    public function deleteAssure(Assure $assure){
        //Requete attendue de type DELETE

        $sql = "DELETE FROM assure WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$assure->getIdAssure()]); // Autre possibilité : array($id)

    }
    public function getListAssure(){
        //Requete attendue de type SELECT(liste des assurés
        $sql = "SELECT * FROM assure";
        $idRequete =  $this->cnx->query($sql);
        while($row = $idRequete->fetch(PDO::FETCH_ASSOC)){
            $assures[] = new Assure($row);
        }
    }
    public function getAssure($id){
        //Requete attendue de type SELECT (1 seul assuré)
        $sql =  "SELECT * FROM assure WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$id]); // Autre possibilité : array($id)
        $row = $idRequete->fetch(PDO::FETCH_ASSOC);

        $oAssure = new Assure($row);  // return new Assure($row);
            return$oAssure;
    }


}