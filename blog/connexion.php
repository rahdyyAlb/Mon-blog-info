<?php

// A- lancer la connexion vers la BDD 

// création des constantes 
define("SERVEUR","db.3wa.io");
define("USER","rahdyalibacari2");
define("MDP","e74fd1bd3aa5bfe26290d5b23c29f011");
define('BDD',"rahdyalibacari2_blog");

try
{
    $connexion = new PDO("mysql:host=".SERVEUR.";dbname=".BDD,USER,MDP);
    // gestion des accents 
    $connexion -> exec("SET CHARACTER SET utf8");// -> appel une méthode d'une classe 
    
    // var_dump($connexion);
}
catch(Exception $message)
{
    echo ' une erruer au moment de la connexion BDD : '.$message->getMessage();
}
