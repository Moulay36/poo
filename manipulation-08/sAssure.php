<?php
// propriétés et méthodes : static
// Constante

const SERVEUR = "localhost";
const BASEDEDONNEES = "assurance";
const UTILISATEUR = "root";
const MOTDEPASSE = "";

$cnx = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASEDEDONNEES, UTILISATEUR, MOTDEPASSE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

require_once 'assure.php';
require_once 'assureManager.php';

$assureManager = new AssureManager($cnx);

//echo count($assureManager->getListAssure());

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <?php
        if (isset($_GET['action']))
        {
            switch($_GET['action']) {
                case "creer":
                    if (isset($_POST['nom']) AND isset($_POST['age']) AND isset($_POST['domicile']))
                    {
                        $assure = new Assure([
                            'nom' => $_POST['nom'],
                            'age' => $_POST['age'],
                            'domicile' => $_POST['domicile'],
                            'bonusMalus' => 0,
                            'pointsFidelite' => 5
                        ]);
                        $assure->setNom($_POST['nom']);
                        $assure->setAge($_POST['age']);
                        $assure->setDomicile($_POST['domicile']);
                        $assureManager->addAssure($assure);
                        $_SESSION['alert'] = [
                            'message' => 'Assuré ajouté avec succès',
                            'type' => 'success'
                        ];
                    } else {
                        $_SESSION['alert'] = [
                            'message' => 'Vous devez remplir le formulaire',
                            'type' => 'danger'
                        ];
                    }
                break;
                case "regler":
                    echo "Reglement";
                break;
                case "supprimer":
                    if ($_GET['idAssure']) {
                        $assureExist = $assureManager->getAssureExist($_GET['idAssure']);

                        if ($assureExist > 0)
                        {
                            $assure = $assureManager->getAssure($_GET['idAssure']);
                            $assureManager->deleteAssure($assure);
                            $_SESSION['alert'] = [
                                'message' => 'Assuré supprimé avec succès',
                                'type' => 'success'
                            ];
                        } else {
                            $_SESSION['alert'] = [
                                'message' => 'Une erreur est survenue lors de la tentative de suppression',
                                'type' => 'danger'
                            ];
                        }
                    }
                break;
            }
        }
    ?>
    <div class="container">
        <h2>Les dossiers assurés</h2>
        <hr>
        <?php if (isset($_SESSION['alert'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['alert']['type'] ?>" role="alert">
                <?php echo $_SESSION['alert']['message']; ?>
            </div>
        <?php } ?>
        <p>Nombre d'assurés : <?php echo $assureManager->getNbreAssure(); ?></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Bonus Malus</th>
                    <th>Fidélité</th>
                    <th>Régler</th>
                    <th>Notification</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for ($i=0; $i<count($assureManager->getListAssure()); $i++) {
                        $idAssure = $assureManager->getListAssure()[$i]->getIdAssure();
                        $nomAssure = $assureManager->getListAssure()[$i]->getNom();
                        $bonusMalusAssure = $assureManager->getListAssure()[$i]->getBonusMalus();
                        $pointsFideliteAssure = $assureManager->getListAssure()[$i]->getPointsFidelite();
                ?>
                <tr>
                    <td><?php echo $idAssure; ?></td>
                    <td><?php echo $nomAssure; ?></td>
                    <td><?php echo $bonusMalusAssure; ?>%</td>
                    <td><?php echo $pointsFideliteAssure ?> points</td>
                    <td>
                        <a class="btn btn-success text-center" href="sAssure.php?action=regler&idAssure=<?php echo $idAssure; ?>">Régler</a>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="sAssure.php?action=accident&idAssure=<?php echo $idAssure; ?>">Accident</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="sAssure.php?action=supprimer&idAssure=<?php echo $idAssure; ?>">Supprimer</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <form action="sAssure.php?action=creer" method="POST">
            <div class="mb-3">
                <label class="form-label" for="nom">Nom</label>
                <input class="form-control" id="nom" name="nom" placeholder="Saisir le nom" type="text">
            </div>
            <div class="mb-3">
                <label class="form-label" for="age">Age</label>
                <input class="form-control" id="age" name="age" placeholder="Saisir l'âge" type="number">
            </div>
            <div class="mb-3">
                <label class="form-label" for="domicile">Domicile</label>
                <input class="form-control" id="domicile" name="domicile" placeholder="Saisir le domicile" type="text">
            </div>
            <button class="btn btn-success" type="submit">Créer</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
