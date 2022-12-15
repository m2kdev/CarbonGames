<?php

header('Content-Type: application/json')
include_once 'config\DataBase.php'

session_start();
if(isset($_POST['username']) && isset($_POST['pswd']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'nsi';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['pswd']));
    $mail = mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "INSERT INTO user(name,pwd,mail) VALUES('".$username."', '".$password."', '".$mail."')";
        $exec_requete = mysqli_query($db,$requete);
        if($exec_requete=false) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           header('Location: login.php');
        }
        else
        {
           header('Location: login.php?erreur=3'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>