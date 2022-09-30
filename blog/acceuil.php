<?php


// passer par le layout 
// --> header et le footer 
require "connexion.php";
// 2- préparer la requete 
// if(array_key_exists('id_art',$_GET) && is_numeric($_GET['id_art']))
// {
//     $id = $_GET['id_art'];
// }
$query = $connexion -> prepare('
                           SELECT
                                article.id_cat,
                            	nomCat,
                                image,
                                `nom`,
                                `prenom`,
                                `titre`,
                                `date`,
                                `contenu`,
                                `id_article`,
                                auteur.id_auteur
                            FROM
                                `article`
                            INNER JOIN categorie ON article.id_cat = categorie.id_cat
                            INNER JOIN auteur ON article.id_auteur = auteur.id_auteur
                            ORDER BY
                                `article`.`id_article`
                            DESC'
                                );// une requete SQL 
// 3- exécuter la requete 

$query -> execute();
// 4- récupérer les infos de la requete 

$articles = $query -> fetchAll(); 
//$rest = substr($articles["contenu"], 0, -1); 


$template = "acceuil";

require "layout.phtml";

// require "page1.phtml";