<?php


// passer par le layout 
// --> header et le footer 
require "connexion.php";
// 2- préparer la requete 
if(array_key_exists('id_art',$_GET) && is_numeric($_GET['id_art']))
 {
     $id = $_GET['id_art'];
 }
        
$query = $connexion -> prepare('
                                SELECT
                                    image,
                                    `titre`,
                                    auteur.nom,
                                    auteur.prenom,
                                    `date`,
                                    `contenu`,
                                    `id_article`,
                                    auteur.id_auteur,
                                    categorie.nomCat,
                                    article.id_cat
                                FROM
                                    `article`
                                INNER JOIN categorie ON article.id_cat = categorie.id_cat
                                INNER JOIN auteur ON article.id_auteur = auteur.id_auteur
                                WHERE
                                    article.id_article = ?
                            ');// une requete SQL 
// 3- exécuter la requete 

$query -> execute([$id]);
// 4- récupérer les infos de la requete 
       
$articles_details = $query -> fetch(); 

//$rest = substr($articles["contenu"], 0, -1); 

// la requete N°2 qui affiche les commentaire d'un article (les 3 étapes )


$query2 = $connexion -> prepare('
                            SELECT
                                pseudo,
                                comm.contenu,
                                comm.date,
                                comm.id_article
                            FROM
                                `comm`
                            INNER JOIN article ON comm.id_article = article.id_article
                            WHERE
                                article.id_article = ?
                            ORDER BY
                                `comm`.`date`
                            DESC
                                ');
                                

$query2 -> execute([$id]);
// 4- récupérer les infos de la requete 

$commentaires = $query2 -> fetchAll(); 
//var_dump($commentaires);
$template = "article";

require "layout.phtml";

// require "page1.phtml";
