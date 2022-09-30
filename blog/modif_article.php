<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
    require "connexion.php";
    // tester l'evoi d'un form 
    
    // récupérer champ par champ
    if(isset($_POST["titre"]) && !empty($_POST["titre"]) && isset($_POST["contenu"]) && !empty($_POST["contenu"]) && isset($_POST["id_auteur"]) && !empty($_POST["id_auteur"]) &&isset($_POST["id_cat"]) && !empty($_POST["id_cat"]))
    {
        
            $titre = $_POST["titre"];
            $contenu = $_POST["contenu"];
            $id_auteur = $_POST["id_auteur"];
            $id_cat = $_POST["id_cat"];
            $id = $_POST["id_article"];
            
            $req = "UPDATE article
                    SET 
                    titre = ?, 
                    contenu = ?, 
                    id_auteur = ?,
                    id_cat = ?,
                    image,
                    WHERE article.id_article = ?";
                                
            // var_dump($req);
            $query = $connexion -> prepare($req);
            $test = $query -> execute([$titre,$contenu,$id_auteur,$id_cat,$id]);
            // var_dump($test);
            // redirection vers admin.php
            if($test)
            {
                  header('location:admin.php');
            }
        
    }
    else{
        if(array_key_exists('id_article',$_GET) && is_numeric($_GET['id_article']))
            {
             $id = $_GET['id_article'];
            }
        // N°1 --> requete qui séléctionne tous les auteurs (3 étapes)
        $query = $connexion -> prepare('
                                        SELECT
                                            `id_article`,
                                            image,
                                            `titre`,
                                            `contenu`,
                                            article.id_cat,
                                            article.id_auteur
                                        FROM
                                            `article`
                                        INNER JOIN auteur ON article.id_auteur = auteur.id_auteur
                                        INNER JOIN categorie ON article.id_cat = categorie.id_cat
                                        WHERE
                                            article.id_article = ?
                                        ORDER BY
                                            `article`.`date`
                                        DESC
                                ');
        $query -> execute([$id]);
        $article_modif = $query -> fetch();
        
        $query2 = $connexion -> prepare('
                                        SELECT
                                            id_auteur,
                                          `nom`,`prenom`
                                        FROM
                                            `auteur`
                                        ORDER BY `auteur`.`id_auteur` ASC
                                ');
        
        $query2 -> execute();
        // 4- récupérer les infos de la requete 
        
        $auteurs = $query2 -> fetchAll(); 
        //  N°2 --> requete qui séléctionne toutes les cat (3 étapes)
        $query3 = $connexion -> prepare('
                            SELECT
                                id_cat,
                                `nomCat`
                            FROM
                                `categorie`
                            ORDER BY `categorie`.`id_cat` ASC
                                ');
                                
        
        $query3 -> execute();
        // 4- récupérer les infos de la requete 
        
        $categories = $query3 -> fetchAll(); 
                
        
        $template = "modif_article";
        // $template = "article";
        
        require "layout.phtml";
        // une rredirection vers la page article --> pour afficher ce nouveau commentaire 
    }
}
else
{
    header('location:admin.php');
}

// else {
//     if($_POST["titre"] &&$_POST["contenu"]) $_POST["contenu"] && $_POST["id_auteur"]  && $_POST["id_cat"])
//     {
//         $titre = $_POST["titre"];
//         $contenu = $_POST["contenu"];
//         $id_auteur = $_POST["id_auteur"];
//         $id_cat = $_POST["id_cat"];
        
//         $req -> $connexion = UPDATE article
//                             SET 
//                             titre = $titre, 
//                             contenu = $contenu, 
//                             id_auteur = $id_auteur
//                             id_cat = $id_cat
//                             WHERE article.id_article = $id
                            
//          var_dump($req);
//         //redirection vers la page des d"=étails 
//          /*if($test)
//          {
//              header('location:admin.php');
//          }*/
//     }
// }









