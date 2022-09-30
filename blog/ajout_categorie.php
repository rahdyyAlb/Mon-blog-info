<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
require "connexion.php";
// tester l'evoi d'un form 

    // récupérer champ par champ
    if(isset($_POST["nomCat"]) && !empty($_POST["nomCat"]))
    {
        $nom= $_POST['nomCat'];

        // lancer une requete d'insertion
        $req = $connexion -> prepare('
                                INSERT INTO categorie (
                                                        nomCat) 
                                VALUES (
                                        :nomCat)
                                    ');
        // si l'isertion est OK
        $req->bindParam(':nomCat', $nom);
        $test = $req->execute();
        // var_dump($test);
        //redirection vers la page des d"=étails 
        if($test)
        {
             //echo "ok";
            header('location:admin.php');
        }
    }
    else
    {
        $template = "ajout_categorie";
        // $template = "article";
        
        require "layout.phtml";
    }
}
else
{
    header('location:admin.php');
}








