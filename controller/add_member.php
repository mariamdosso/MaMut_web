<?php
include ('../config.php');

if (isset($_POST['name'], 
          $_POST['prenom'], 
          $_POST['date_naissance'],
          $_POST['date_adhesion'], 
          $_POST['genre'], 
          $_POST['ville'],
          $_POST['commune'], 
          $_POST['quartier'], 
          $_POST['contact'], 
          $_POST['profession'], 
          $_POST['role'], 
          $_POST['email'], 
          $_POST['password'], 
          $_POST['confirm_password']) 
    && !empty($_POST['name']) 
    && !empty($_POST['prenom']) 
    && !empty($_POST['date_naissance']) 
    && !empty($_POST['date_adhesion']) 
    && !empty($_POST['genre']) 
    && !empty($_POST['ville']) 
    && !empty($_POST['commune']) 
    && !empty($_POST['quartier']) 
    && !empty($_POST['contact']) 
    && !empty($_POST['profession']) 
    && !empty($_POST['role']) 
    && !empty($_POST['email']) 
    && !empty($_POST['password']) 
    && !empty($_POST['confirm_password']) 
) {
    $nom = $_POST['name'];
    $prenom = $_POST['prenom'];
    $birthday = $_POST['date_naissance'];
    $date_adhesion = $_POST['date_adhesion'];
    $genre = $_POST['genre'];
    $ville = $_POST['ville'];
    $commune = $_POST['commune'];
    $quartier = $_POST['quartier'];
    $contact = $_POST['contact'];
    $profession = $_POST['profession'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit(); 
    } 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_sql = "SELECT * FROM member WHERE email_member = :email";
    $stmt = $pdo->prepare($check_sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé !";
    } else {
        $sql = "INSERT INTO member (
                    member_name,
                    firstname_member,
                    date_birth_member,
                    membership_date,
                    gender_member,
                    member_city,
                    member_municipality,
                    member_district,
                    contact_member,
                    profession_member,
                    role_member,
                    email_member,
                    password_member
                ) VALUES (
                    :nom,
                    :prenom,
                    :birthday,
                    :date_adhesion,
                    :genre,
                    :ville,
                    :commune,
                    :quartier,
                    :contact,
                    :profession,
                    :role,
                    :email,
                    :hashed_password
                )";

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
           'member_name' => $nom,
            `firstname_member` => $prenom,
            'date_birth_member' => $birthday,
            'membership_date' => $date_adhesion,
            'gender_member' => $genre,
            'member_city' => $ville,
            'member_municipality' => $commune,
            'member_district' => $quartier,
            'contact_member' => $contact,
            'profession_member' => $profession,
            'role_member' => $role,
            'email_member' => $email,
            'password_member' => $password
    ]);

        if ($result) {
            echo "Membre ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du membre.";
        }
    }
} else {
    echo "Tous les champs sont requis.";
}
?>


