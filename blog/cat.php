<?php


// passer par le layout 
// --> header et le footer 
require "connexion.php";
// 2- préparer la requete 
if(array_key_exists('id_cat',$_GET) && is_numeric($_GET['id_cat']))
 {
     $id_cat = $_GET['id_cat'];
 }
        
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
                                WHERE 
                                categorie.id_cat =?
                            ');// une requete SQL 
// 3- exécuter la requete 

$query -> execute([$id_cat]);
// 4- récupérer les infos de la requete 
       
$categories = $query -> fetchAll(); 

//$rest = substr($articles["contenu"], 0, -1); 

// la requete N°2 qui affiche les commentaire d'un article (les 3 étapes )

//var_dump($commentaires);
$template = "cat";

require "layout.phtml";

// require "page1.phtml";
