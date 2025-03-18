<?php
require 'fonction_controller.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
$resultat =  deleteMembre($id) ;
    echo "Le membre supprimer est : $resultat ";
    header('Location:http://localhost/MaMut_web/member_list');

}
// if (deleteMembre($id)) {
//              echo "<script>
//                    Swal.fire({
//                          title: 'Modifié !',
//                          text: 'Le membre a été mis à jour avec succès.',
//                          icon: 'success'
//                      }).then(() => {
//                         window.location.href = 'modifier'; 
//                     });
//                   </script>";
//          } else {
//             echo "<script>
//                     Swal.fire('Erreur', 'La modification a échoué.', 'error');
//                   </script>";
//         }

     ?>
    
    
?>
