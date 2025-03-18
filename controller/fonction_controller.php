<?php

include("config/db.php");  

function deleteMembre($id) {
    global $pdo;  
    $sql = "DELETE FROM member WHERE member_id='$id'";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute();
}

function getMemberById($pdo, $id) {
    if ($id <= 0) return null;

    $sql = "SELECT * FROM member WHERE member_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function updateMember($pdo, $data) {
    $sql = "UPDATE member SET 
        member_name = :name,
        firstname_member = :prenom,
        date_birth_member = :date_naissance,
        membership_date = :date_adhesion,
        gender_member = :genre,
        member_city = :ville,
        member_municipality = :commune,
        member_district = :quartier,
        contact_member = :contact,
        professio_member = :profession,
        role_member = :fonction,
        email_member = :email
        WHERE member_id = :id";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ":name" => htmlspecialchars(trim($data['name'])),
        ":prenom" => htmlspecialchars(trim($data['prenom'])),
        ":date_naissance" => $data['date_naissance'],
        ":date_adhesion" => $data['date_adhesion'],
        ":genre" => $data['genre'],
        ":ville" => htmlspecialchars(trim($data['ville'])),
        ":commune" => htmlspecialchars(trim($data['commune'])),
        ":quartier" => htmlspecialchars(trim($data['quartier'])),
        ":contact" => htmlspecialchars(trim($data['contact'])),
        ":profession" => htmlspecialchars(trim($data['profession'])),
        ":fonction" => htmlspecialchars(trim($data['fonction'])),
        ":email" => htmlspecialchars(trim($data['email'])),
        ":id" => (int) $data['id']
    ]);
}

?>
