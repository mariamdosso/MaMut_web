<?php
session_start();
include('../config/db.php');

function parseDate($input)
{
    $d = DateTime::createFromFormat('Y-m-d', $input); // format HTML5
    if ($d !== false) return $d;

    $d = DateTime::createFromFormat('d/m/Y', $input); // format manuel
    if ($d !== false) return $d;

    return false;
}


// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_info']['id'])) {
    $_SESSION['errorMessage'] = "Vous devez être connecté pour ajouter un adhérent.";
    header('Location: /MaMut_web/login');
    exit();
}

$message = "";

if (
    isset(
        $_POST['full_name'],
        $_POST['birth_date'],
        $_POST['date_of_joining'],
        $_POST['gender'],
        $_POST['city'],
        $_POST['municipality_department'],
        $_POST['call_number'],
        $_POST['address'],
        $_POST['email']
    )
    && !empty($_POST['full_name'])
    && !empty($_POST['birth_date'])
    && !empty($_POST['date_of_joining'])
    && !empty($_POST['gender'])
    && !empty($_POST['city'])
    && !empty($_POST['municipality_department'])
    && !empty($_POST['address'])
    && !empty($_POST['call_number'])
    && !empty($_POST['email'])
) {
    $fullname = $_POST['full_name'];
    $birthday = $_POST['birth_date'];
    $date_adhesion = $_POST['date_of_joining'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $phone = $_POST['call_number'];
    $municipality = $_POST['municipality_department'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $birthday = parseDate($_POST['birth_date']);
    $date_adhesion = parseDate($_POST['date_of_joining']);

    if (!$birthday || !$date_adhesion) {
        $_SESSION['errorMessage'] = "Format de date invalide (utilisez jj/mm/aaaa ou yyyy-mm-dd).";
        header('Location: http://localhost/MaMut_web/add_member.php');
        exit();
    }

    $birthday = $birthday->format('Y-m-d');
    $date_adhesion = $date_adhesion->format('Y-m-d');

  

    $check_sql = "SELECT * FROM adherent WHERE email= :email";
    $stmt = $pdo->prepare($check_sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['errorMessage'] = "Cet email est déjà utilisé !";
        header('Location: /MaMut_web/add_member');
        exit();
    } else {

      $created_by = $_SESSION['user_info']['id'];
        $sql = "INSERT INTO adherent (
            full_name,
            birth_date,
            date_of_joining,
            gender,
            city,
            municipality_department,
            call_number,
            email,
            address,
            created_by
        ) VALUES (
            :full_name,
            :birth_date,
            :date_of_joining,
            :gender,
            :city,
            :municipality_department,
            :call_number,
            :email,
            :address,
            :created_by
        )";

        $adherent_data = [
            'full_name'               => $fullname,
            'birth_date'              => $birthday,
            'date_of_joining'         => $date_adhesion,
            'gender'                  => $gender,
            'city'                    => $city,
            'municipality_department' => $municipality,
            'call_number'             => $phone,
            'email'                   => $email,
            'address'                 => $address,
            'created_by'              => $created_by
        ];

        var_dump($adherent_data);

        $stmt = $pdo->prepare($sql);
        var_dump($adherent_data);
        $result = $stmt->execute($adherent_data);
        

        if ($result) {
            $_SESSION['successMessage'] = "Membre ajouté avec succès !";
            header('location://localhost:8000/MaMut_web/member_list');
        } else {
            $_SESSION['errorMessage'] = "Erreur lors de l'ajout du membre.";
            header('location://localhost:8000/MaMut_web/add_member');
        }
    }
} else {
    $_SESSION['errorMessage'] = "Tous les champs sont requis.";
    header('location://localhost:8000/MaMut_web/add_member');
}
