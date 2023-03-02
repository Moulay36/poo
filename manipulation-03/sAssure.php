<?php


require_once 'assure.php';

$oAssure1= new Assure();
$oAssure2 = new Assure();

$oAssure1->reglerAssurance();

/* $oAssure1->reglerAssurance(); */

$oAssure1->parrainer($oAssure2);

$oAssure1->avoirAccident();

$oAssure2->reglerAssurance();



echo "le BM de l'assuré 01 est de : " . $oAssure1->getBonusMalus() .  "<br>";

/* $oAssure1->parrainer($oAssure2); */

echo "le BM de l'assuré 02 est de : " . $oAssure2->getBonusMalus() .  "<br>";





//var_dump($oAssure1);
//var_dump($oAssure2);

