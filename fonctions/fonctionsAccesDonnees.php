<?php
/**
 * @access private
 * @return type
 */
function chargeJSONseminaire()
{
	$json_source = file_get_contents('data/seminaire.json');
    $document = json_decode($json_source);
    return $document;
}

/**
 * @access private
 * @return type
 */
function chargeJSONprofessions()
{
	$json_source = file_get_contents('data/professions.json');
    $document = json_decode($json_source);
    return $document;
}

/**
 * @access private
 * @param type $doc
 */
function sauveJSONseminaire($doc){
    $json_data = json_encode($doc, JSON_PRETTY_PRINT);
    file_put_contents('data/seminaire.json', $json_data);
}

/**
 * @access private
 * @return type
 */
function chargeJSONadmin()
{
    $json_source = file_get_contents('data/admin.json');
    $document = json_decode($json_source);
    return $document;
}

/**
 * Retourne l'intitulé du séminaire
 * @return chaîne
 */
function donnerIntituleSeminaire()
{
	$document = chargeJSONseminaire();
	return $document->seminaire->intitule;   	
}

/**
 * Retourne la liste de tous les créneaux horaires, heures de début des conférences
 * le tableau retourné commence à l'indide 0
 * @return  tableau 
 * 
 */
function donnerLesHeuresCreneaux(){
	$document = chargeJSONseminaire();
	foreach($document->seminaire->creneau as $valeur){
	$ListeHeure[] = $valeur->heure;
	}
	return $ListeHeure;
}

/**
 * Retourne toutes les conférences commençant à l'heure donnée sous forme d'un tableau
 * @param chaîne $heure
 * @return  tableau 
 */

function donnerLesConferences($heure){
	$document = chargeJSONseminaire();
	foreach($document->seminaire->creneau as $creneau){
		if ($creneau->heure == $heure){
			foreach($creneau->conference as $conference){
				$tabConf[] = $conference;
			}
		}
	}
	return $tabConf;

}

/**
 * Enregistre les informations d'un visiteur
 * @param chaîne $nom
 * @param chaîne $prenom
 * @param chaîne $mail
 * @param chaîne $ville
 * @param chaîne $profession
 */
function sauverDonneesInscription($nom, $prenom,$mail,$ville, $profession){

	session_start();
	$_SESSION['nom'] = $nom;
	$_SESSION['prenom'] = $prenom;
	$_SESSION['mail'] = $mail;
	$_SESSION['ville'] = $ville;
	$_SESSION['profession'] = $profession;
	print_r($_SESSION);

}

/**
 * Retourne toutes les professions possibles
 * le tableau retourné commence à l'indice 0
 * @return  tableau 
 */
function donnerLesProfessions(){
	$document = chargeJSONprofessions();
	return $document->professions;
}

/**
 * Vérifie si le visiteur a déjà rempli son formulaire d'inscription
 * @return boolean
 */
function estInscrit(){
	if (isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['mail']) && isset($_SESSION['ville']) && isset($_SESSION['profession'])){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Enregistre un participant et ses choix de conférences
 * @param tableau $lesChoix : les choix du participant
 */
function enregistre($lesChoix){
	// Enregistrer le participant dans la conférence choisis avec lesChoix dans le JSON
	$document = chargeJSONseminaire();
	foreach ($lesChoix as $choix) {
		foreach ($document->seminaire->creneau as $creneau) {
			foreach ($creneau->conference as $conference) {
				if ($conference->id == $choix) {
					if (!isset($conference->participants)) {
						$conference->participants = [];
					}
					$participant = [
						'nom' => $_SESSION['nom'],
						'prenom' => $_SESSION['prenom'],
						'mail' => $_SESSION['mail'],
						'ville' => $_SESSION['ville'],
						'profession' => $_SESSION['profession']
					];
					$conference->participants[] = $participant;
				}
			}
		}
	}
	sauveJSONseminaire($document);
	
	
}

/**
 * Retourne toutes conférences sous forme d'un tableau
 * Le tableau commençe à l'indice 0
 * Chaque ligne du tableau contient les information sur une conférence :
 * son id, son creneau,sa description, son intervenant, sa salle et son nbPlaces
 * @return tableau
 */
function donnerToutesLesConferences(){
	$document = chargeJSONseminaire();
	foreach($document->seminaire->creneau as $creneau){
		foreach($creneau->conference as $conference){
			$tabConf[] = $conference;
		}
	}
	return $tabConf;
	// ******* A COMPLETER ******* 
}

/**
 * Retourne tous les participants inscrits à une conférence dont on fournit le numéro
 * Chaque ligne du tableau retourné contient le nom, le prénom, la profession,
 * la ville et le mail d'un participant
 * @param entier $numConference
 * @return  tableau 
 */
function donnerParticipants($numConference)
{
	// ******* A COMPLETER ******* 
	$document = chargeJSONseminaire();
	foreach($document->seminaire->creneau as $creneau){
		foreach($creneau->conference as $conference){
			if ($conference->id == $numConference){
				foreach($conference->participants as $participant){
					$tabPart[] = $participant;
				}
			}
		}
	}
}
function donnerTousParticipants()
{
    $document = chargeJSONseminaire();
    $tabPart = [];

    foreach ($document->seminaire->creneau as $creneau) {
        foreach ($creneau->conference as $conference) {
            foreach ($conference->participants as $participant) {
                // Ajouter les infos de la conférence au participant
                $participant->conference = [
                    "id" => $conference->id,
                    "description" => $conference->description,
                ];
                $tabPart[] = $participant;
            }
        }
    }

    return $tabPart;
}

?>
