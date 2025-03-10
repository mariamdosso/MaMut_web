<?php
require 'fonction_controller.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ('deleteMembre'($id)) {
        echo "<script>
                Swal.fire({
                    title: 'Supprimé !',
                    text: 'Le membre a été supprimé avec succès.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'dashboard.php'; 
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Erreur', 'Impossible de supprimer ce membre.', 'error');
              </script>";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
