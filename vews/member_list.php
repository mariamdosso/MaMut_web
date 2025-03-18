

<?php 
require("controller/member_list_controller.php");
?>
<div class="container mt-5 w-100 ">
        <h1 class="text-center mb-4">Gestion des Membres</h1>
        <a href="add_member" class="btn btn-primary mb-3">Ajouter un membre</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>contact</th>
                    <th>genre</th>
                    <th>ville</th>
                    <th>commune</th>
                    <th>quartier</th>
                </tr>
            </thead>
            <tbody>
            <?php  if (count($members)){ 
                foreach($members as $member){
                     ?>
                <tr>
                    <td>1</td>
                    <td> <?= $member["member_name"];?></td>
                    <td><?= $member["firstname_member"];?> </td>
                    <td><?= $member["date_birth_member"];?></td>
                    <td><?= $member["contact_member"];?></td>
                    <td><?= $member["gender_member"];?></td>
                    <td><?= $member["member_city"];?></td>
                    <td><?= $member["member_municipality"];?></td>
                    <td><?= $member["member_district"];?></td>
                    <td>
                    
                        <a href="modifier?id=<?=$member['member_id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="remove_member?id=<?=$member['member_id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                <?php
                            }
                        }
                            ?>
            </tbody>
        </table>
    </div>