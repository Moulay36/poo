<?php




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

        <div class="col-md-12 hidden-sm hidden-xs"><img src="images/banner.webp"></div>

    </header>

    <div class="row pos">
        <nav class="col-md-3">

            <ul class="list-group">
                <li class="list-group-item"><a href="sAssure.php">Accueil</a>
            </ul>
        </nav>

        <main class="col-md-9">
            <h1>Les dossiers assurés</h1>
            <p> Nombre d'assurés : <strong> <!-- Compteur --></strong></p>
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
							// Si vide
							// MEssage Aucun assuré trouvé !!
							// Sinon lister les assurés (foreach ($assures as $unAssure))
								 {
									echo '<tr>
										<th scope="row"></th>
										<td></td>
										<td></td>
										<td></td>
										<td>Bouton Régler
										</td>
										<td>Bouton Accident
										</td>
										</td>
										<td>Bouton Supprimer
										</td>
									</tr>';

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
