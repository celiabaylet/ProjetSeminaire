<?php 
include "./vue/entete.php";
?>

<?php
echo"<form action='./?action=choixconferences' method='POST'>";         //action=default
$heures = donnerLesHeuresCreneaux();
foreach ($heures as $heure){
	echo"<table>";
		echo"<th>$heure</th>";
		$LesConferences = donnerLesConferences($heure);
		foreach ($LesConferences as $UneConference){
		echo"<tr>";
			echo"<td>$UneConference->description</td>";
			echo"<td>$UneConference->salle</td>";
			echo"<td><input type= 'radio' name='$heure' value='$UneConference->id'></td>";
		echo"</tr>";
		}
	echo"</table>";
}
		echo"<br><br>";
	echo"<table>";
		echo"<tr>";
			echo"<td><input type='submit' value='valider' name='bouton'></td>";
			echo"<td><input type='reset' value='annuler' name='bouton'></td>";
		echo"<tr>";
	echo"</table>";
echo"</form>";
?>

<?php 
include "./vue/pied.php";
?>
