<?php
include_once "fonctions/fonctionsGestion.php";
include_once "fonctions/fonctionsAccesDonnees.php";
 
$btn = "Inscription";
if (isset($_POST["btn"])){
   $btn = $_POST["btn"];
   $nom = $_POST["nom"];
   $prenom = $_POST["prenom"];
   $mail = $_POST["mail"];
   $ville = $_POST["ville"];
   $profession = $_POST["profession"];
}
 
switch ($btn){
   case "Annuler" :
      $nom = '';
      $prenom = '';
      $mail = '';
      $ville = '';
 
      break;
     
   case "Valider" :
     
      verifierDonneesInscription($nom, $prenom, $mail, $ville);
      if (donnerNbErreurs() != 0){
         afficherErreurs();
         break;
      }
 
      sauverDonneesInscription($nom, $prenom, $mail, $ville, $profession);
      echo "<h2>Votre inscription a été prise en compte, il faut procéder au choix des conférences</h2>";
     
         break;
}
include "./vue/vueInscription.php";
 
?>