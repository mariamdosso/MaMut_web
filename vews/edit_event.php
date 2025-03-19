<div class="container mt-5 w-100 d-flex  justify-content-center">
<div class="card p-4 shadow-sm " style="width: 45rem;">
        <h2>modifier un événement</h2>

<?php
            include("config/db.php");

            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
            $event = [];

        if ($id > 0) {
            $sql = "SELECT * FROM event WHERE event_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $event = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
?>
                 
            
        <?php if (!empty($event)) : ?>
        <?php foreach ($event as $events) : ?>
        <form method="POST" action="controller/update_event_controller.php" class="mt-6">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="mb-3">
                <label class="form-label">Libellé</label>
                <input type="text" name="libelle" class="form-control" placeholder="libelle" value="<?php echo htmlspecialchars($events->event_label); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" placeholder="type" value="<?php echo htmlspecialchars($events->event_type); ?>" required?>
            </div>
            <div class="mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domaine" class="form-control" placeholder="domaine" value="<?php echo htmlspecialchars($events->event_domain); ?>" required >
            </div>
            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" class="form-control" placeholder="date_debut" value="<?php echo htmlspecialchars($events->event_date_start); ?>" required >
            </div>
            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" placeholder="date_fin" value="<?php echo htmlspecialchars($events->event_date_end); ?>" required >
            </div>
            <div class="mb-3">
                <input type="number" name="participation" placeholder="participation" value="<?php echo htmlspecialchars($events->event_periodicity); ?>" > Participation requise
            </div>

            <div class="mb-3">
                <input type="date" name="periode" placeholder="periode" value="<?php echo htmlspecialchars($events->event_contribution_amount); ?>" > Periodicite
            </div>
            <button type="submit"  name="modifier" class="btn btn-primary">modifier</button>
        </form>
        </div>
    </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>Aucun membre trouvé.</p>
<?php endif; ?>
