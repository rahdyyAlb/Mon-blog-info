<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
    require "connexion.php";
    if(array_key_exists('id_auteur',$_GET) && is_numeric($_GET['id_auteur']))
    {
        $id = $_GET['id_auteur'];
            
        $query = $connexion -> prepare('
                                        DELETE
                                        FROM
                                            `auteur`
                                        WHERE
                                            `id_auteur` = ?
                                ');
        $test=$query -> execute([$id]);
        //var_dump($test);
        if($test)
            {
                  header('location:admin.php');
            }    
                            
    }
}
else
{
    header('location:admin.php');
}
