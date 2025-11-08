<?php
include(__DIR__ . '/../config/db.php');

// Vérifier qu'un ID est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de l'événement manquant ou invalide.");
}

$event_id = (int)$_GET['id'];

// Récupérer l'événement à modifier
$stmt = $pdo->prepare("SELECT * FROM event WHERE id = :id");
$stmt->execute([':id' => $event_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die("Événement non trouvé.");
}

// Récupération des types d’événements actifs
$typeStmt = $pdo->query("SELECT id, label FROM event_type WHERE status = 1 ORDER BY label ASC");
$types = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content d-flex flex-column flex-column-fluid">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div id="kt_content_container" class=" container-xxl ">
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form action="/MaMut_web/edit_event_controller" method="POST">
                    <!-- Champ caché pour l'ID -->
                    <input type="hidden" name="id" value="<?= $event['id'] ?>">

                    <div class="mb-8">
                        <label>Label de l'événement</label>
                        <input type="text" name="label" class="form-control" value="<?= htmlspecialchars($event['label']) ?>" required>
                    </div>

                    <div class="mb-8">
                        <label>Montant de l'événement</label>
                        <input type="number" name="event_amount" class="form-control" value="<?= $event['event_amount'] ?>" required>
                    </div>

                    <div class="mb-8">
                        <label>Montant cible de l'événement</label>
                        <input type="number" name="event_target_participation" class="form-control" value="<?= $event['event_target_participation'] ?>" required>
                    </div>

                    <div class="row mb-8">
                        <div class="col-md-6">
                            <label>Date de début</label>
                            <input type="date" name="event_start_date" class="form-control" value="<?= $event['event_start_date'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Date de fin</label>
                            <input type="date" name="event_end_date" class="form-control" value="<?= $event['event_end_date'] ?>" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label>Participation</label><br>
                        <label><input type="radio" name="with_participation" value="1" <?= $event['with_participation'] ? 'checked' : '' ?>> Oui</label>
                        <label><input type="radio" name="with_participation" value="0" <?= !$event['with_participation'] ? 'checked' : '' ?>> Non</label>
                    </div>

                    <div class="mb-8">
                        <label>Type d'événement</label>
                        <select name="event_type_id" class="form-control" required>
                            <option value="">Sélectionner un type</option>
                            <?php foreach ($types as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= $t['id'] == $event['event_type_id'] ? 'selected' : '' ?>><?= htmlspecialchars($t['label']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-8">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($event['description']) ?></textarea>
                    </div>

                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-3">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
               <div id="formResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>