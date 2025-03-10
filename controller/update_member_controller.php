<?php
require_once 'functions.php';  

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = [
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

    if (updateMembre($id, $data)) {
        echo "<script>
                Swal.fire({
                    title: 'Modifié !',
                    text: 'Le membre a été mis à jour avec succès.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'modifier'; 
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Erreur', 'La modification a échoué.', 'error');
              </script>";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
