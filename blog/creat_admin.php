<?php
require "connexion.php";

$identifiant="Ali69b";
$mdp =password_hash("Alb123456789",PASSWORD_DEFAULT); 
$query = $connexion-> prepare('
                            INSERT INTO `admin`( `identifiant`, `mdp`)
                            VALUES(?,?)
                            ');
$test = $query->execute(array($identifiant,$mdp));

var_dump($test);