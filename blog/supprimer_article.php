<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
    require "connexion.php";
    if(array_key_exists('id_article',$_GET) && is_numeric($_GET['id_article']))
    {
        $id = $_GET['id_article'];
            
        $query = $connexion -> prepare('
                                        DELETE
                                        FROM
                                            `article`
                                        WHERE
                                            `id_article` = ?
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
