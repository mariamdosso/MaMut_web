<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);8*

ini_set('display_errors', 0);
error_reporting(0);

session_start();
include("config/db.php");

header('Content-Type: application/json');


if (!isset($_SESSION['user_info']['user_id'])) {
    echo json_encode(['success' => false, 'message' => "Utilisateur non connecté."]);
    exit;
}

$user_id = $_SESSION['user_info']['user_id'];

if (
    isset($_POST['libelle'], $_POST['type'], $_POST['domaine'], $_POST['date_debut'], $_POST['date_fin'])
    && !empty($_POST['libelle']) && !empty($_POST['type']) && !empty($_POST['domaine'])
    && !empty($_POST['date_debut']) && !empty($_POST['date_fin'])
) {
    
    $libelle = htmlspecialchars($_POST['libelle']);
    $type = htmlspecialchars($_POST['type']);
    $domaine = htmlspecialchars($_POST['domaine']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $periodicite = !empty($_POST['periode']) ? $_POST['periode'] : null;

    $has_participation = isset($_POST['has_participation']) ? 1 : 0;
    $participation = $has_participation ? (isset($_POST['participation']) ? $_POST['participation'] : 0) : 0;


    try {
        
        $sql = "INSERT INTO event (event_label, event_type, event_domain, event_date_start, event_date_end, event_periodicity, event_contribution_amount, user_id)
                VALUES (:event_label, :event_type, :event_domain, :event_date_start, :event_date_end, :event_periodicity, :event_contribution_amount, :user_id)";
       
       $stmt = $pdo->prepare($sql);
        $requestData=[
            "event_label" => $libelle,
            "event_type" => $type,
            "event_domain" => $domaine,
            "event_date_start" => $date_debut,
            "event_date_end" => $date_fin,
            "event_periodicity" => $periodicite,
            "event_contribution_amount" => $participation,
            "user_id" => intval($user_id)
        ];
echo json_encode(['success' => true, 'message' => $requestData]);
    exit;
        $result = $stmt->execute();

            

        if ($result) {
            $event_id = $pdo->lastInsertId();

            
            if ($has_participation && !empty($_POST['membres'])) {
                $membres = $_POST['membres'];

                $stmtParticipation = $pdo->prepare("INSERT INTO participation (event_id, member_id, amount) VALUES (:event_id, :member_id, :amount)");

                foreach ($membres as $member_id) {
                    $stmtParticipation->execute([
                        "event_id" => $event_id,
                        "member_id" => $member_id,
                        "amount" => $participation
                    ]);
                }
            }

            echo json_encode(['success' => true, 'message' => "Événement ajouté avec succès."]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erreur lors de l'ajout de l'événement."]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Erreur : " . $e->getMessage(),'error' => $e]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Veuillez remplir tous les champs obligatoires."]);
}

