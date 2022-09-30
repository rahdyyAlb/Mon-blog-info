<?php

// connnexion 
require "connexion.php";
// tester l'evoi d'un form 

    // récupérer champ par champ
    if(isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) && isset($_POST["commentaire"]) && !empty($_POST["commentaire"]))
    {
        $comm= $_POST['commentaire'];
        $pseudo= $_POST['pseudo'] ;
        $id = $_POST['id_article'];
        // lancer une requete d'insertion
        $req = $connexion -> prepare('
                                INSERT INTO comm (
                                                    `pseudo`,
                                                    `contenu`,
                                                    `id_article`,
                                                    `date`) 
                                VALUES (
                                        :pseudo, 
                                        :contenu,
                                        :id_article,
                                        NOW()
                                        )
                                    ');
        // si l'isertion est OK
        $req->bindParam(':pseudo', $pseudo);
        $req->bindParam(':contenu', $comm);
        $req->bindParam(':id_article', $id);
        $test = $req->execute();
        
        // var_dump($test);
        //redirection vers la page des d"=étails 
        if($test)
        {
            header('location:article.php?id_art='.$id);
        }
    }
    else{
        echo "veuillez remplir tout les champs";
    }

 





// $template = "article";

// require "layout.phtml";
// une rredirection vers la page article --> pour afficher ce nouveau commentaire 


