<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
require "connexion.php";
// tester l'evoi d'un form 

    // récupérer champ par champ
    if(isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]))
    {
        $nom= $_POST['nom'];
        $prenom=$_POST['prenom'];
        // lancer une requete d'insertion
        $req = $connexion -> prepare('
                                INSERT INTO auteur (
                                                        `nom`,
                                                    `prenom`) 
                                VALUES (
                                        :nom,
                                        :prenom)
                                    ');
        // si l'isertion est OK
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $test = $req->execute();
        // var_dump($test);
        //redirection vers la page des d"=étails 
        if($test)
        {
            // echo "ok";
             header('location:admin.php');
        }
    }
    else
    {
        $template = "ajout_auteur";
        // $template = "article";
        
        require "layout.phtml";
    }
}
else
{
    header('location:admin.php');
}








