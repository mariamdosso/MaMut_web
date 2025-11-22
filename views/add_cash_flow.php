<?php
// Connexion
include("config/db.php");
?>

<div class="container d-flex justify-content-center align-items-center vh-100 bg-secondary">
    <div class="card p-4 shadow-lg bg-white rounded-4" style="width: 26rem;">
        <h2 class="mb-4 text-center">Ajouter un flux</h2>
        <form action="controller/add_cash_flow_controller.php" method="POST">
            
            <div class="mb-3">
                <label class="form-label">Description :</label>
                <input type="text" class="form-control" name="description" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Montant :</label>
                <input type="number" class="form-control" name="montant" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type :</label>
                <select class="form-select" name="type">
                    <option value="entrer">Entrée</option>
                    <option value="sortie">Sortie</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date :</label>
                <input type="date" class="form-control" name="date_operation" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Caisse concernée :</label>
                <select class="form-select" name="fund_id">
                    <?php
                    $stmt = $pdo->query("SELECT fund_id, fund_name FROM fund");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='{$row['fund_id']}'>{$row['fund_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
        </form>
    </div>
</div>


