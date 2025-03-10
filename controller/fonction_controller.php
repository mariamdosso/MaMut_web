<?php

include("../config/db.php");  

function deleteMembre($id) {
    global $pdo;  
    $sql = "DELETE FROM member WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function updateMembre($id, $data) {
    global $pdo;  
    $fields = [];
    foreach ($data as $key => $value) {
        $fields[] = "$key = :$key";
    }
    $sql = "UPDATE member SET " . implode(", ", $fields) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $data['id'] = $id;
    return $stmt->execute($data);
}
?>
