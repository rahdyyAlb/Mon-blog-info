<?php
session_start();
// connnexion 
if(isset($_SESSION["admin"]))
{
    require "connexion.php";
    if(array_key_exists('id_cat',$_GET) && is_numeric($_GET['id_cat']))
    {
        $id = $_GET['id_cat'];
            
        $query = $connexion -> prepare('
                                        DELETE
                                        FROM
                                            `categorie`
                                        WHERE
                                            `id_cat` = ?
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
