<?php

const SERVEUR = "localhost";
const BASEDEDONNEES = "assurance";
const UTILISATEUR = "root";
const MOTDEPASSE = "";


$cnx = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASEDEDONNEES, UTILISATEUR, MOTDEPASSE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));