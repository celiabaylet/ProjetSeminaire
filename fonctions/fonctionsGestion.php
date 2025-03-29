<?php
/**
 * Vérifie le login et le mot de passe afin d'autoriser ou pas le visiteur à visualiser les inscriptions
 * @param chaîne $login
 * @param chaîne $mdp
 */
function verifier($login,$mdp){
   //Ecrire la fonction qui permet de vérifier le login et le mot de passe afin d'autoriser ou non le visiteur à visualiser les inscriptions.
   //Si le login et mot de passe correspondent à l'admin, on chargera une variable de session $_SESSION['admin']=1
   $document = chargeJSONadmin();
   foreach($document->users as $users){
      if ($users->login == $login && $users->mdp == $mdp){

         $_SESSION['admin']=1;
         return true;
      }
}
}
/**
 * Retourne vrai si le visiteur est un administrateur connecté <br> et autorisé à visualiser les inscriptions
 * @return booléen
 */
function estAdmin(){
    if (isset($_SESSION['admin']) && $_SESSION['admin']==1){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Vérifie les données saisies
 * @param chaîne $nom
 * @param chaîne $prenom
 * @param chaîne $mail
 * @param chaîne $ville
 */
function verifierDonneesInscription($nom, $prenom, $mail, $ville)
{
  
    if ($nom=="" || $prenom=="" || $mail=="" || $ville=="" )
   {
		ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
     
   }
   if (!preg_match("/^[-a-z0-9\._]+@[-a-z0-9\.]+\.[a-z]{2,4}$/i", $mail))
		ajouterErreur("Le format de l'email n'est pas valide");

}
/*					 FONCTIONS DE GESTION DES ERREURS			*/


/**
 * @access private
 * @param type $msg
 */
function ajouterErreur($msg)
{
   if (! isset($_GET['erreurs']))
		$_GET['erreurs']=array();
	$_GET['erreurs'][]=$msg;
}
/**
 * Retourne le nombre de messages d'erreurs de saisie
 * @return entier
 */
function donnerNbErreurs()
{
   if (!isset($_GET['erreurs']))
   {
	   return 0;
	}
	else
	{
	   return count($_GET['erreurs']);
	}
}
/**
 * Affiche toutes les erreurs de saisie
 */
function afficherErreurs()
{
   echo '<div>';
   echo '<ul>';
   foreach($_GET['erreurs'] as $erreur)
	{
      echo "<li>$erreur</li>";
	}
   echo '</ul>';
   echo '</div>';
}

?>
