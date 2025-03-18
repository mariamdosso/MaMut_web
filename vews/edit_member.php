<?php
include("config/db.php");

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$member = [];

if ($id > 0) {
    $sql = "SELECT * FROM member WHERE member_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $member = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>

<?php if (!empty($member)) : ?>
    <?php foreach ($member as $members) : ?>
        <form method="POST" action="controller/update_member_controller.php" class="mt-6">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom" value="<?php echo htmlspecialchars($members->member_name); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($members->firstname_member); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" value="<?php echo htmlspecialchars($members->date_birth_member); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Date d'adhésion :</label>
                    <input type="date" class="form-control" name="date_adhesion" value="<?php echo htmlspecialchars($members->membership_date); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre :</label>
                    <input type="radio" name="genre" value="femme" <?php echo ($members->gender_member == 'femme') ? 'checked' : ''; ?> required>
                    <label for="femme">Femme</label>

                    <input type="radio" name="genre" value="homme" <?php echo ($members->gender_member == 'homme') ? 'checked' : ''; ?> required>
                    <label for="homme">Homme</label>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville" value="<?php echo htmlspecialchars($members->member_city); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Commune :</label>
                    <input type="text" class="form-control" name="commune" value="<?php echo htmlspecialchars($members->member_municipality); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="quartier" class="form-label">Quartier :</label>
                    <input type="text" class="form-control" name="quartier" value="<?php echo htmlspecialchars($members->member_district); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="contact" value="<?php echo htmlspecialchars($members->contact_member); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="profession" class="form-label">Profession :</label>
                    <input type="text" class="form-control" name="profession" value="<?php echo htmlspecialchars($members->professio_member); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Fonction :</label>
                    <select id="fonction" name="fonction" class="form-select" required>
                        <option value="membre" <?php echo ($members->role_member == 'membre') ? 'selected' : ''; ?>>Membre</option>
                        <option value="president" <?php echo ($members->role_member == 'president') ? 'selected' : ''; ?>>Président</option>
                        <option value="secretaire_generale" <?php echo ($members->role_member == 'secretaire_generale') ? 'selected' : ''; ?>>Secrétaire Générale</option>
                        <option value="vice_president" <?php echo ($members->role_member == 'vice_president') ? 'selected' : ''; ?>>Vice Président</option>
                        <option value="tresorier" <?php echo ($members->role_member == 'tresorier') ? 'selected' : ''; ?>>Trésorier</option>
                        <option value="secretaire" <?php echo ($members->role_member == 'secretaire') ? 'selected' : ''; ?>>Secrétaire</option>
                        <option value="autre" <?php echo ($members->role_member == 'autre') ? 'selected' : ''; ?>>Autre</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($members->email_member); ?>" required>

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

