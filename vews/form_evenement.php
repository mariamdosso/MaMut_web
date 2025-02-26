
    <div class="container mt-5">
        <h2><?= $event_id ? "Modifier" : "Créer" ?> un événement</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Libellé</label>
                <input type="text" name="libelle" class="form-control" required value="<?= htmlspecialchars($event['libelle']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" required value="<?= htmlspecialchars($event['type']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domaine" class="form-control" required value="<?= htmlspecialchars($event['domaine']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" class="form-control" required value="<?= $event['date_debut'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" required value="<?= $event['date_fin'] ?>">
            </div>
            <div class="mb-3">
                <input type="checkbox" name="participation" <?= $event['participation'] ? "checked" : "" ?>> Participation requise
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

