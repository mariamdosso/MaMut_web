<?php 
require("controller/event_list_controller.php");
?>

<div class="container my-5">
    <h2 class="mb-4">Gestion des événements</h2>
    <a href="add_event.php" class="btn btn-primary mb-3">Ajouter un événement</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Libellé</th>
                <th>Type</th>
                <th>Domaine</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Périodicité</th>
                <th>Cotisation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($events)) : 
            foreach($events as $event) : ?>
            <tr>
                <td><?= $event["event_label"];?></td>
                <td><?= $event["event_type"];?></td>
                <td><?= $event["event_domain"];?></td>
                <td><?= $event["event_date_start"];?></td>
                <td><?= $event["event_date_end"];?></td>
                <td><?= $event["event_periodicity"] ?? '—';?></td>
                <td><?= $event["event_contribution_amount"];?> FCFA</td>
                <td>
                    <a href="update_event?id=<?=$event['event_id']?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="remove_event?id=<?=$event['event_id']?>" class="btn btn-danger btn-sm">Supprimer</a>
                    <button class="btn btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#participants<?= $event['event_id']?>" aria-expanded="false" aria-controls="participants<?= $event['event_id']?>">Participants</button>
                </td>
            </tr>
            <tr class="collapse" id="participants<?= $event['event_id']?>">
                <td colspan="8">
                    <?php if (count($event['participants'])) : ?>
                        <ul class="list-group">
                            <?php foreach ($event['participants'] as $participant) : ?>
                                <li class="list-group-item"><?= htmlspecialchars($participant['member_name']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-muted">Aucun participant enregistré.</p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

