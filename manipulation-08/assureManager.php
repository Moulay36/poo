<?php

class AssureManager {

    private $cnx;
    private $message;

    public function __construct($cnx)
    {
        $this->setCnx($cnx);
    }

    public function setCnx($cnx)
    {
        $this->cnx = $cnx;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    // Partie CRUD consultation (liste et fiche), ajout, la modification et la suppression
    public function addAssure(Assure $assure)
    {
        // Requête attendue de type INSERT

        $sql = "INSERT INTO assure (nom, age, domicile, bonusMalus, pointsFidelite) VALUES (?,?,?,?,?)";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$assure->getNom(), $assure->getAge(), $assure->getDomicile(), $assure->getBonusMalus(), $assure->getPointsFidelite()]);
    }

    public function editAssure(Assure $assure)
    {
        // Requête attendue de type UPDATE
        $sql = "UPDATE assure SET nom = ?, age = ?, domicile = ?, bonusMalus = ?, pointsFidelite = ? WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$assure->getNom(), $assure->getAge(), $assure->getDomicile(), $assure->getBonusMalus(), $assure->getPointsFidelite(), $assure->getIdAssure()]);
    }

    public function deleteAssure(Assure $assure)
    {
        // Requête attendue de type DELETE
        $sql = "DELETE FROM assure WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$assure->getIdAssure()]);
    }

    public function getListAssure()
    {
        // Requête attendue de type SELECT (Liste des assurés)
        $sql = "SELECT * FROM assure";
        $idRequete = $this->cnx->query($sql);
        while ($row = $idRequete->fetch(PDO::FETCH_ASSOC))
        {
            $assures[] = new Assure($row);
        }

        return $assures;
    }

    public function getAssure($id)
    {
        // Requête attendue de type SELECT (1 seul assuré)
        $sql = "SELECT * FROM assure WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$id]);
        $row = $idRequete->fetch(PDO::FETCH_ASSOC);

        return new Assure($row);
    }

    public function getAssureExist($id)
    {
        // Requête attendue de type SELECT (1 seul assuré)
        $sql = "SELECT * FROM assure WHERE idAssure = ?";
        $idRequete = $this->cnx->prepare($sql);
        $idRequete->execute([$id]);
        $row = $idRequete->fetch(PDO::FETCH_ASSOC);
        $exist = $idRequete->rowCount();

        return $exist;
    }

    public function getNbreAssure()
    {
        return count($this->getListAssure());
    }

    public function getMessage()
    {
        return $this->message;
    }
}