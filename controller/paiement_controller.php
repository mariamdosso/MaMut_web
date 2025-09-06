<<?php
// Connexion à la base de données
require_once 'connexion.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sécurisation et récupération des données
    $event_id     = intval($_POST['event_id']);
    $member_id    = intval($_POST['member_id']);
    $montant_paye = floatval($_POST['montant_paye']);
    $date_paiement = date('Y-m-d H:i:s');

    // Vérifier si les champs sont bien remplis
    if ($event_id <= 0 || $member_id <= 0 || $montant_paye <= 0) {
        die("Données invalides.");
    }

    // Récupérer la participation existante pour ce membre et cet événement
    $sql = "SELECT p.id, p.montant_participation, p.montant_paye, p.fund_id, e.type_evenement, e.date_echeance
            FROM participation p
            JOIN evenement e ON p.event_id = e.id
            WHERE p.event_id = ? AND p.member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$event_id, $member_id]);
    $participation = $stmt->fetch();

    if (!$participation) {
        die("Participation introuvable.");
    }

    // Calcul du reste à payer
    $reste_a_payer = $participation['montant_participation'] - $participation['montant_paye'];

    // Vérifie que le montant payé ne dépasse pas le reste à payer
    if ($montant_paye > $reste_a_payer) {
        die("Montant payé supérieur au reste à payer.");
    }

    // Nouvelle somme payée
    $nouveau_paye = $participation['montant_paye'] + $montant_paye;

    // Définir statut de solde
    $statut_solde = ($nouveau_paye >= $participation['montant_participation']) ? 'soldé' : 'en attente';

    // Début de transaction SQL pour sécuriser toutes les opérations ensemble
    $conn->beginTransaction();

    try {
        // 1️⃣ Mettre à jour la participation
        $updateParticipation = "UPDATE participation 
                                SET montant_paye = ?, statut_solde = ? 
                                WHERE id = ?";
        $stmt = $conn->prepare($updateParticipation);
        $stmt->execute([$nouveau_paye, $statut_solde, $participation['id']]);

        // 2️⃣ Créer un flux dans cash_flow
        $insertFlux = "INSERT INTO cash_flow (fund_id, event_id, member_id, montant, type_flux, date_flux)
                       VALUES (?, ?, ?, ?, 'participation', ?)";
        $stmt = $conn->prepare($insertFlux);
        $stmt->execute([
            $participation['fund_id'],
            $event_id,
            $member_id,
            $montant_paye,
            $date_paiement
        ]);

        // 3️⃣ Mettre à jour le montant de la caisse
        $updateFund = "UPDATE fund 
                       SET montant = montant + ? 
                       WHERE id = ?";
        $stmt = $conn->prepare($updateFund);
        $stmt->execute([$montant_paye, $participation['fund_id']]);

        // Valider la transaction
        $conn->commit();

        // Retour utilisateur
        echo "✅ Paiement enregistré avec succès. Statut : $statut_solde.";

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $conn->rollBack();
        die("Erreur lors du traitement : " . $e->getMessage());
    }

} else {
    die("Accès non autorisé.");
}
?>
