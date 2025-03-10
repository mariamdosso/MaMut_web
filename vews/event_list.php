<?php 
require("controller/event_list_controller.php");
?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Gestion des evenements</h1>
        <a href="ajouter_membre.php" class="btn btn-primary mb-3">Ajouter un evenement</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>libelle</th>
                    <th>type</th>
                    <th>domaine</th>
                    <th>date de debut</th>
                    <th>date de fin</th>
                    <th>periodicite</th>
                    <th>montant de cotisation</th>
                </tr>
            </thead>
            <tbody>
            <?php  if (count($events)){ 
                foreach($events as $event){
                     ?>
                <tr>
                    <td> <?= $event["event_label"];?></td>
                    <td><?= $event["event_type"];?> </td>
                    <td><?= $event["event_domaine"];?></td>
                    <td><?= $event["event_date_start"];?></td>
                    <td><?= $event["event_date_end"];?></td>
                    <td><?= $event["event_periodicity"];?></td>
                    <td><?= $event["event_contribution_amount"];?></td>
                    <td>
                    
                        <a href="modifier?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_member.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                <?php
                            }
                        }
                            ?>
            </tbody>
        </table>
    </div>

