<?php


require_once 'assure.php';

$oAssure = new Assure();

// var_dump(oAssure);

echo "l'objet  \$oAssure est type" . gettype($oAssure) . "<br>";

echo "l'age de l'objet  \$oAssure est " . $oAssure->age . "<br>";

$oAssure->age =  $oAssure->age + 2;
echo "l'age de l'objet \$oAssure est :" . $oAssure->age;