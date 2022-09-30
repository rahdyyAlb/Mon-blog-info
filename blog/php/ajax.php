<?php


// passer par le layout 
// --> header et le footer 
require "../connexion.php";
// 2- préparer la requete 
     
$query = $connexion -> prepare('
                                SELECT
                                    `id_com`,
                                    `pseudo`,
                                    `contenu`,
                                    `date`,
                                    `id_article`
                                FROM
                                    `comm`
                                ORDER BY
                                    `comm`.`date`
                                DESC
                                LIMIT 5
                            ');// une requete SQL 
// 3- exécuter la requete 

$query -> execute();
// 4- récupérer les infos de la requete 
       
$cam5 = $query -> fetchAll(); 

//$rest = substr($articles["contenu"], 0, -1); 

// la requete N°2 qui affiche les commentaire d'un article (les 3 étapes )

//var_dump($cam5);
require "ajax.phtml";




