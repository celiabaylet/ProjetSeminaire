<?php
include_once "fonctions/fonctionsGestion.php";
include_once "fonctions/fonctionsAccesDonnees.php";

if (isset($_POST["btn"])){
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $admin = verifier($login,$mdp);

    if ($admin != false){
        session_start();
        $_SESSION["admin"] = $admin;
        $_SESSION["login"] = $login;
        $_SESSION["mdp"] = $mdp;

        echo "Vous êtes connectés en tant qu'administrateur";
        #print_r($_SESSION);
    }
    else{
        echo "Login ou mot de passe incorrect";
    }

}

include "./vue/vueConnexion.php";

?>
