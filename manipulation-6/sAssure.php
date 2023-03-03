<?php
// propriétés et méthodes : static
//constante


require_once 'assure.php';

$oassure1 = new Assure('Zoe',28,'Paris');
var_dump($oassure1);

$oassure2 = new Assure('Alain',28,'Châteauroux');
var_dump($oassure2);

$oassure1->reglerAssurance();
$oassure1->parrainer($oassure2);
$oassure2->avoirAccident();
$oassure2->reglerAssurance();
$oassure1->setBonusMalus(20);
$oassure1->setPointsFidelite(20);
$oassure1->reglerAssurance();

echo "Le nombre de points de fidélité de Zoé est de : " . $oassure1->getpointFidelite();
echo "<br>";
echo "Le nombre de points de fidélité de Alain est de : " . $oassure2->getpointFidelite();
echo "<br>";
echo "Le Bonus Malus de Zoé est de : " . $oassure1->getBonusMalus();
echo "<br>";
echo "Le Bonus Malus de Alain est de : " . $oassure2->getBonusMalus();

// :: Opérateur de résolution de portée (Double 2 points)
/* echo Assure::$information;

echo assure::OR;

echo assure::ARGENT;

*/
