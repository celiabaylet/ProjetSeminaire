<?php 
include "./vue/entete.php";
?>

<?php
$heures = donnerLesHeuresCreneaux();

foreach($heures as $heure){

	echo "<table>";
		echo"<th>$heure</th>";
		echo"<th>Intervenant</th>";
		echo"<th>Salle</th>";
		$LesConferences = donnerLesConferences($heure);
		foreach ($LesConferences as $UneConference){
		echo"<tr>";
			echo"<td>$UneConference->description</td>";
			echo"<td>$UneConference->intervenant</td>"; 
			echo"<td>$UneConference->salle</td>";
		echo"</tr>";
		}
	echo"</table>";
}
?>

<?php 
include "./vue/pied.php";
?>

