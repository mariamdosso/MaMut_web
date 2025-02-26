<?php

include ('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = ( $_POST['nom']);
    $prenom =( $_POST['prenom']);
    $birthday = ($_POST['date_naissance']);
    $date_adhesion = ( $_POST['date_adhesion']);
    $genre = ( $_POST['genre']);
    $ville = ( $_POST['ville']);
    $commune = ( $_POST['commune']);
    $quartier = ( $_POST['quartier']);
    $contact = ( $_POST['contact']);
    $profession = ( $_POST['profession']);
    $role = ( $_POST['role']);
    $email = ( $_POST['email']); 
    $password = ( $_POST['password']);

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $check_sql = "SELECT * FROM member WHERE email_member='$email'";
    $result = mysqli_query($pdo, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Cet email est déjà utilisé !";
    } else {
        
        $sql = "INSERT INTO member (`member_name` ,
                                    `firstname_member`,
                                     `date_ birth_member`,
                                     `membership_date`,
                                     `gender_member`,
                                     `member_city`,
                                     `member_municipality`,
                                     `member_district`,
                                    `contact_member`,
                                     `professio_member`,
                                     `role_member`, 
                                     `email_member`) 
                        VALUES ('$nom',
                         '$prenom',
                         '$birthday',
                         '$date_adhesion',
                         '$genre',
                       '$ville',
                       '$commune',
                       '$quartier',
                       '$contact',
                       '$profession',
                       '$role',
                       '$email')";
        if (mysqli_query($pdo, $sql)) {
            echo "Membre ajouté avec succès !";
        } else {
            echo "Erreur : " . mysqli_error($pdo);
        }
    }
}

mysqli_close($pdo);
?>
