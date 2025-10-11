<?php
include("config/db.php");

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$member = [];

if ($id > 0) {
    $sql = "SELECT * FROM adherent WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $adherent = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>

<?php if (!empty($adherent)) : ?>
    <?php foreach ($adherent as $adherents) : ?>
        <form method="POST" action="controller/update_member_controller.php" class="mt-6">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">NOM COMPLET :</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom" value="<?php echo htmlspecialchars($adherents->full_name); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Date d'adhesion :</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($adherents->date_of_joining); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" value="<?php echo htmlspecialchars($adherents->birth_date); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Contact :</label>
                    <input type="number" class="form-control" name="contact" value="<?php echo htmlspecialchars($adherents->call_number); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville" value="<?php echo htmlspecialchars($adherents->city); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Commune ou departement:</label>
                    <input type="text" class="form-control" name="commune" value="<?php echo htmlspecialchars($adherents->municipality_department); ?>" required>
                </div>
                
            </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($adherents->email); ?>" required>

                </div>
            </div>

            <div class="d-flex p-2 w-100 justify-content-center">
                <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
            </div>
        </form>
    <?php endforeach; ?>
<?php else : ?>
    <p>Aucun membre trouvé.</p>
<?php endif; ?>

