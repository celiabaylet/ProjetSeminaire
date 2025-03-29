<?php
//affichage des conferences

include_once "./fonctions/fonctionsAccesDonnees.php";
include_once "./fonctions/fonctionsGestion.php";

session_start();

if(estInscrit() == false){
    header("Location: ./?action=inscription.php");
}

$btn = "choixconferences";
if (isset($_POST["bouton"])){
   $btn = $_POST["bouton"];
   $lesChoix = $_POST;
}

switch ($btn){
    case "annuler" :
  
       break;
      
    case "valider" :
        print_r($_REQUEST);
        enregistre($lesChoix);
        break;          
}

include "./vue/vueChoixconferences.php"


?>
