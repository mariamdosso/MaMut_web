<?php
include ('config/db.php'); // Connexion à la BDD

// Récupérer les événements
$evenements = $pdo->query("SELECT * FROM event");

// Récupérer les membres
$membres = $pdo->query("SELECT * FROM member");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evenement_id = $_POST['evenement'] ?? null;
    $membres_selectionnes = $_POST['member'] ?? [];

    if ($evenement_id && !empty($membres_selectionnes)) {
        foreach ($membres_selectionnes as $membre_id) {
            $stmt = $pdo->prepare("INSERT INTO participation (member_id, event_id) VALUES (:member_id, :event_id)");
            $stmt->bindValue(':member_id', $membre_id, PDO::PARAM_INT);
            $stmt->bindValue(':event_id', $evenement_id, PDO::PARAM_INT);
            $stmt->execute();
        }
        
        echo "✅ Participants ajoutés avec succès !";
    } else {
        echo "⚠️ Veuillez sélectionner un événement et au moins un participant.";
    }
}
?>

<form method="POST">
    <label>Choisir un événement :</label>
    <select name="evenement">
        <?php while ($event = $evenements->fetch()) { ?>
            <option value="<?= htmlspecialchars($event['event_id']) ?>"><?= htmlspecialchars($event['libelle']) ?></option>
        <?php } ?>
    </select>

    <label>Choisir les participants :</label>
    <select name="member[]" multiple>
        <?php while ($membre = $membres->fetch()) { ?>
            <option value="<?= htmlspecialchars($membre['member_id']) ?>"><?= htmlspecialchars($membre['name']) ?></option>
        <?php } ?>
    </select>

    <button type="submit">Ajouter</button>
</form>
