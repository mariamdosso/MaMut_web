<?php
require 'fonction_controller.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
$resultat =  deleteMembre($id) ;
    echo "Le membre supprimer est : $resultat ";
    header('Location:http://localhost/MaMut_web/member_list');

}

     ?>
    
