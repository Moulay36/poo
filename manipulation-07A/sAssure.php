<?php
// Partie PHP
require_once 'assure.php';
require_once 'assureManager.php';

$cnx = new PDO('mysql:host=localhost;dbname=assurance', 'root','');
$m = new AssureManager($cnx);

    if(isset($_POST['btn_creer'])){
        // Gestion de l'ajout d'un assuré
        $assure = new assure(['nom' => $_POST['nom'], 'age' => $_POST['age'], 'domicile' => $_POST['domicile'], 'bonusMalus' => 0, 'pointsFidelite' => 5]);
        $m->addAssure($assure);
    }

    if(isset($_POST['btn_regler'])){
        // Gestion du réglement de l'assurance function reglerAssurance()
//        var_dump($_POST);
        $assure = $m->getAssure($_POST['idAssure']);
        $assure->reglerAssurance();
        $m->editAssure($assure);
    }

    if(isset($_POST['btn_accident'])){
        // Gestion avoir accident function avoirAccident()
        $assure = $m->getAssure($_POST['idAssure']);
        $assure->avoirAccident();
        $m->editAssure($assure);
    }

    if(isset($_POST['btn_supprimer'])){
        // Gestion de la suppression d'un assuré function deleteAssure()
        $assure = $m->getAssure($_POST['idAssure']);
        $m->deleteAssure($assure);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Les dossiers Assurés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">

    <header class="row">

        <div class="col-md-12 hidden-sm hidden-xs"><img src="images/banner.jpg"></div>

    </header>

    <div class="row pos">
        <nav class="col-md-3">

            <ul class="list-group">
                <li class="list-group-item"><a href="sAssure.php">Accueil</a> </div>
            </ul>
        </nav>

        <main class="col-md-9">
            <h1>Les dossiers assurés</h1>
            <p> Nombre d'assurés : <strong> <?php echo $m->count(); ?></strong></p>
            <table class="table">
                <thead class="">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Bonus Malus</th>
                    <th scope="col">Fidélité</th>
                    <th scope="col">Régler</th>
                    <th scope="col">Notification</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
							// Récupération d'un tableau d'objets (Cf. getListAssure())
                            $assures = $m->getListAssure();
                            // Vérification
//                            var_dump($assures);
							// Si vide
                if(empty($assures)){
                    // Message Aucun assuré trouvé !!
                    echo "Aucun assuré trouvé !!";
                    }else {
                    // Sinon lister les assurés (foreach ($assures as $unAssure))
                    foreach ($assures as $unAssure) {
                        echo '<tr>
										<th scope="row"> '. $unAssure->getIdAssure() . '</th>
										<td>'. $unAssure->getNom() . '</td>
										<td>'. $unAssure->getBonusMalus() . '</td>
										<td>'. $unAssure->getPointsFidelite() . '</td>
										<td>
										<form action="sAssure.php" method="POST">
										<input type="hidden" name="idAssure" value="'. $unAssure->getIdAssure() . '">
										        <button type="submit" class="btn btn-primary btn-sm" name="btn_regler">Régler</button>
										</form>
										</td>
										<td>
										<form action="sAssure.php" method="POST">
										<input type="hidden" name="idAssure" value="'. $unAssure->getIdAssure() . '">
										    <button type="submit" class="btn btn-primary btn-sm" name="btn_accident">Accident</button>
										</form>
										</td>
										</td>
										<td>
										<form action="sAssure.php" method="POST">
										<input type="hidden" name="idAssure" value="'. $unAssure->getIdAssure() . '">
										    <button type="submit" class="btn btn-primary btn-sm" name="btn_supprimer">Supprimer</button> 
										</form>
										</td>
									    </tr>';


                    }
                }
                ?>

                </tbody>
            </table>
            <div class="row">

                <div class="col-md-7">
                    <p>Zone de message
                    </p>

                    <form method='POST' action='sAssure.php'>
                        <div class="form-group">
                            <label for="f_nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name='nom' placeholder="Saisir le nom">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" id="age" name='age' placeholder="Saisir l'âge">
                        </div>
                        <div class="form-group">
                            <label for="domicile">Domicile</label>
                            <input type="text" class="form-control" id="domicile" name='domicile' placeholder="Saisir le domicile">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm" name='btn_creer'>Créer</button>


                    </form>
                </div>
                <div class="col-md-5"></div>

            </div>
        </main>
    </div>

    <footer class="row pos">
        <div class="col-md-12 text-center">&copy; 2023 Campus-Centre - TP Manipulation 08 </div>
    </footer>

</div>

</body>
</html>
