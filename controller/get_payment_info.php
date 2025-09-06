<<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = intval($_POST['event_id']);
    $member_id = intval($_POST['member_id']);

    // Vérification des données
    if ($event_id <= 0 || $member_id <= 0) {
        die("Données invalides.");
    }

    // Récupérer les infos de participation
    $sql = "SELECT p.montant_participation, p.montant_paye, p.statut_solde, 
                   e.type_evenement, e.date_echeance
            FROM participation p
            JOIN evenement e ON p.event_id = e.id
            WHERE p.event_id = ? AND p.member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$event_id, $member_id]);
    $data = $stmt->fetch();

    if ($data) {
        // Calcul du reste à payer
        $reste_a_payer = $data['montant_participation'] - $data['montant_paye'];

        // Générer un tableau HTML ou JSON selon le besoin
        echo "
            <p><strong>Type d'événement :</strong> {$data['type_evenement']}</p>
            <p><strong>Montant participation :</strong> {$data['montant_participation']} FCFA</p>
            <p><strong>Montant déjà payé :</strong> {$data['montant_paye']} FCFA</p>
            <p><strong>Reste à payer :</strong> {$reste_a_payer} FCFA</p>
            <p><strong>Statut de solde :</strong> {$data['statut_solde']}</p>
            <p><strong>Date échéance :</strong> {$data['date_echeance']}</p>
        ";
    } else {
        echo "Aucune participation trouvée pour ce membre et cet événement.";
    }

} else {
    die("Accès non autorisé.");
}
?>
