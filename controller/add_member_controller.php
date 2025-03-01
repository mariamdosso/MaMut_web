<?php
session_start();
include ('../config/db.php');

$message = "";

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
          $_POST['fonction'], 
          $_POST['email'],) 
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
    && !empty($_POST['fonction']) 
    && !empty($_POST['email']) 
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
    $role = $_POST['fonction'];
    $email = $_POST['email'];


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
                    professio_member,
                    role_member,
                    email_member
        
                ) VALUES (
                    :member_name,
                    :firstname_member,
                    :date_birth_member,
                    :membership_date,
                    :gender_member,
                    :member_city,
                    :member_municipality,
                    :member_district,
                    :contact_member,
                    :professio_member,
                    :role_member,
                    :email_member 
                )";
            
        $stmt = $pdo->prepare($sql);
        $member_data = [
            'member_name' => $nom,
             'firstname_member' => $prenom,
             'date_birth_member' => $birthday,
             'membership_date' => $date_adhesion,
             'gender_member' => $genre,
             'member_city' => $ville,
              'member_municipality' => $commune,
             'member_district' => $quartier,
             'contact_member' => $contact,
             'professio_member' => $profession,
             'role_member' => $role,
             'email_member' => $email
 
        ];
        $result = $stmt->execute($member_data); 
        if ($result) {
            $_SESSION['successMessage'] = "Membre ajouté avec succès !";
            header('location://localhost/MaMut_web/add_member');  
        } else {
            $_SESSION['errorMessage'] = "Erreur lors de l'ajout du membre.";
            header('location://localhost/MaMut_web/add_member');  
        }
    }
} else {
    $_SESSION['errorMessage'] = "Tous les champs sont requis.";
    header('location://localhost/MaMut_web/add_member');
            
}
?>


