<?php
session_start();
if (!isset($_SESSION["admin"])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ./?action=validerConnexion");
    exit();
}
?>

<?php 
include "./vue/entete.php";
echo "Vous êtes connectés en tant qu'administrateur";

// Récupérer TOUS les participants
$participants = donnerTousParticipants();

echo "<form action='./?action=voirinscriptions' method='POST'>"; 

if (!empty($participants)) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Ville</th>
            <th>Profession</th>
            <th>Conférence</th>
          </tr>";

          
    $conferencePrecedente = null; // Variable pour suivre la conférence précédente

    foreach ($participants as $UnParticipant) {
        $conferenceActuelle = htmlspecialchars($UnParticipant->conference["description"]);

        // Si la conférence change, on ajoute une ligne vide pour créer un espacement
        if ($conferencePrecedente !== null && $conferencePrecedente !== $conferenceActuelle) {
            echo "<tr><td colspan='6' style='height: 20px; background-color: #f8f8f8;'></td></tr>";
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($UnParticipant->nom) . "</td>";
        echo "<td>" . htmlspecialchars($UnParticipant->prenom) . "</td>";
        echo "<td>" . htmlspecialchars($UnParticipant->mail) . "</td>";
        echo "<td>" . htmlspecialchars($UnParticipant->ville) . "</td>";
        echo "<td>" . htmlspecialchars($UnParticipant->profession) . "</td>";
        echo "<td>" . $conferenceActuelle . "</td>";
        echo "</tr>";

        $conferencePrecedente = $conferenceActuelle; // Mise à jour de la conférence précédente
    }

    echo "</table>";
} else {
    echo "<p>Aucun participant trouvé.</p>";
}

echo "</form>";

include "./vue/pied.php";
?>
