<?php


// passer par le layout 
// --> header et le footer 
require "connexion.php";
// 2- préparer la requete 
session_start();
// vérifier l'envoi des infos du form 
if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
    
    // récupérer les infos du form champs par champ 
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $mdp = htmlspecialchars($_POST['mdp']);
    
    // recupérer via la BDD 
    
    $query = $connexion -> prepare("
                                    SELECT
                                        `id_admin`,
                                        `identifiant`,
                                        `mdp`
                                    FROM
                                        `admin` 
                                    WHERE identifiant = ?
                                    ");
    $query -> execute([$identifiant]);
    
    $adminBDD = $query -> fetch();
    
    // je test les deux infos (form et de la BDD)
    
    if($adminBDD)
    {
        // tester le mot de passe 
        if(password_verify($mdp,$adminBDD['mdp']))
        {
            $_SESSION["admin"]['id_admin'] = $adminBDD['id_admin'];
            $_SESSION["admin"]['identifiant'] = $adminBDD['identifiant'];
           header("location:admin.php");
        }
        else
        {
            echo "le mot de passe est incorrect";
        }
    }
    else
    {
        echo " le client n'existe pas";
    }
    
}

$query = $connexion -> prepare('
                            SELECT
                                `id_article`,
                                `titre`,
                                `date`,
                                `contenu`,
                                auteur.nom,
                                auteur.prenom,
                                nomCat
                            FROM
                                `article`
                            INNER JOIN auteur ON article.id_auteur = auteur.id_auteur
                            INNER JOIN categorie ON article.id_cat = categorie.id_cat
                            ORDER BY
                                `article`.`date`
                            DESC
                                ');
$query -> execute();
$amdin_articles = $query -> fetchAll();


$query = $connexion -> prepare('
                                SELECT
                                    `id_auteur`,
                                    `nom`,
                                    `prenom`
                                FROM
                                    `auteur`
                                ORDER BY
                                    `auteur`.`id_auteur` ASC
                                ');
$query -> execute();
$amdin_auteurs = $query -> fetchAll();

$query = $connexion -> prepare('
                                SELECT
                                    `id_cat`,
                                    `nomCat`
                                FROM
                                    `categorie`
                                ORDER BY
                                    `categorie`.`id_cat` ASC
                                ');
$query -> execute();
$amdin_cats = $query -> fetchAll();


$template = "admin";

require "layout.phtml";


