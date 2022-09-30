<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
require "connexion.php";
// tester l'evoi d'un form 

    // récupérer champ par champ
    if(isset($_POST["titre"]) && !empty($_POST["titre"]) && isset($_POST["contenu"]) && !empty($_POST["contenu"]) && isset($_POST["id_auteur"]) && !empty($_POST["id_auteur"]) &&isset($_POST["id_cat"]) && !empty($_POST["id_cat"]) &&isset($_FILES["image"]) && !empty($_FILES["image"]))
    {
        $titre= $_POST['titre'];
        $contenu= $_POST['contenu'];
        $auteur=$_POST['id_auteur'];
        $categorie = $_POST['id_cat'];
        $image = $_FILES['image']["name"];
        $uploads_dir = 'images';
        if (!empty($_FILES['image']['name'])) 
        { 
            //si le nom de l'image n'est pas vide
            $tmp_name = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }
        // lancer une requete d'insertion
        $req = $connexion -> prepare('
                                INSERT INTO article (
                                                    `titre`,
                                                    `contenu`,
                                                    id_auteur,
                                                    `id_cat`,
                                                    date,
                                                    image) 
                                VALUES (
                                        :titre, 
                                        :contenu,
                                        :id_auteur,
                                        :id_cat,
                                        NOW(),
                                        :image)
                                    ');
        // si l'isertion est OK
        $req->bindParam(':titre', $titre);
        $req->bindParam(':contenu', $contenu);
        $req->bindParam(':id_auteur', $auteur);
        $req->bindParam(':id_cat', $categorie);
        $req->bindParam(':image', $image);
        $test = $req->execute();
        
        
        // var_dump($test);
        //redirection vers la page des d"=étails 
        if($test)
        {
             header('location:admin.php');
        }
    }
    else{
        
        // N°1 --> requete qui séléctionne tous les auteurs (3 étapes)
        $query = $connexion -> prepare('
                                        SELECT
                                            id_auteur,
                                          `nom`,`prenom`
                                        FROM
                                            `auteur`
                                        ORDER BY `auteur`.`nom` ASC
                                ');

        $query -> execute();
        // 4- récupérer les infos de la requete 
        
        $auteurs = $query -> fetchAll(); 
        //  N°2 --> requete qui séléctionne toutes les cat (3 étapes)
        $query2 = $connexion -> prepare('
                            SELECT
                                id_cat,
                                `nomCat`
                            FROM
                                `categorie`
                            ORDER BY `categorie`.`nomCat` ASC
                                ');
                                

        $query2 -> execute();
        // 4- récupérer les infos de la requete 
        
        $categories = $query2 -> fetchAll(); 
                
        
        $template = "ajout_article";
        // $template = "article";
        
        require "layout.phtml";
        // une rredirection vers la page article --> pour afficher ce nouveau commentaire 
    }

}
else
{
    header('location:admin.php');
}








