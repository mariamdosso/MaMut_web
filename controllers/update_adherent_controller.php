<?php
session_start();
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'ID depuis le champ caché du formulaire
    $id = $_POST['adherent_id'] ?? 0;
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $date_of_joining = $_POST['date_of_joining'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $municipality_department = $_POST['municipality_department'] ?? '';
    $call_number = $_POST['call_number'] ?? '';
    $address = $_POST['address'] ?? '';

    // Validation simple
    if (empty($full_name) || empty($email)) {
        $_SESSION['errorMessage'] = "Nom et email obligatoires !";
        header("Location: ../modifier.php?id=$id");
        exit;
    }

    // UPDATE corrigé : colonne 'id' dans la table
    $sql = "UPDATE adherent 
            SET full_name = :full_name, 
                email = :email, 
                birth_date = :birth_date, 
                date_of_joining = :date_of_joining, 
                gender = :gender, 
                city = :city, 
                municipality_department = :municipality_department, 
                call_number = :call_number, 
                address = :address
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $full_name,
        ':email' => $email,
        ':birth_date' => $birth_date,
        ':date_of_joining' => $date_of_joining,
        ':gender' => $gender,
        ':city' => $city,
        ':municipality_department' => $municipality_department,
        ':call_number' => $call_number,
        ':address' => $address,
        ':id' => $id
    ]);

    $_SESSION['successMessage'] = "Adhérent mis à jour avec succès !";
    header('location://localhost:8000/MaMut_web/member_list');
    exit;
}
