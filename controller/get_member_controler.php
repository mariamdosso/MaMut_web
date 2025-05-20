<?php
require_once('config/db.php'); // adapte selon ton projet

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("SELECT * FROM members WHERE member_id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($member) {
        echo json_encode($member);
    } else {
        echo json_encode(['error' => 'Membre non trouvé']);
    }
}
?>
