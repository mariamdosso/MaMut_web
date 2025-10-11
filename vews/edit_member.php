<div class="container mt-5 w-100 d-flex justify-content-center">
    <div class="card p-4 shadow-sm" style="width: 45rem;">
        <h4 class="text-uppercase fw-bold text-center">Modifier un adhérent</h4>
        <h6 class="text-lowercase fw-bold text-center mt-4">Veuillez modifier les champs ci-dessous</h6>

        <?php if (isset($_SESSION['errorMessage'])): ?>
            <p class="alert alert-danger fw-bold">
                <?= $_SESSION['errorMessage']; ?>
            </p>
            <?php unset($_SESSION['errorMessage']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['successMessage'])): ?>
            <p class="alert alert-success fw-bold">
                <?= $_SESSION['successMessage']; ?>
            </p>
            <?php unset($_SESSION['successMessage']); ?>
        <?php endif; ?>

        <form method="POST" action="controller/update_adherent_controller.php?id=<?= $adherent['adherent_id'] ?>" class="mt-6">
            <input type="hidden" name="adherent_id" value="<?= $adherent['adherent_id'] ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nom complet :</label>
                    <input type="text" class="form-control" name="full_name"
                        value="<?= htmlspecialchars($adherent['full_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email"
                        value="<?= htmlspecialchars($adherent['email'] ?? '') ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">

                    <label class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="birth_date"
                        value="<?= htmlspecialchars($adherent['birth_date'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date d'adhésion :</label>
                    <input type="date" class="form-control" name="date_of_joining"
                        value="<?= htmlspecialchars($adherent['date_of_joining'] ?? '') ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Genre :</label><br>

                        <input type="radio" id="femme" name="gender" value="femme"
                            <?= (isset($adherent['gender']) && $adherent['gender'] === 'femme') ? 'checked' : '' ?> required>
                        <label for="femme">Femme</label>

                        <input type="radio" id="homme" name="gender" value="homme"
                            <?= (isset($adherent['gender']) && $adherent['gender'] === 'homme') ? 'checked' : '' ?> required>
                        <label for="homme">Homme</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ville :</label>
                        <input type="text" class="form-control" name="city"
                            value="<?= htmlspecialchars($adherent['city'] ?? '') ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Département / Commune :</label>
                    <input type="text" class="form-control" name="municipality_department"
                        value="<?= htmlspecialchars($adherent['municipality_department'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="call_number"
                        value="<?= htmlspecialchars($adherent['call_number'] ?? '') ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Adresse :</label>
                    <input type="text" class="form-control" name="address"
                        value="<?= htmlspecialchars($adherent['address'] ?? '') ?>" required>
                </div>
            </div>


            <div class="d-flex p-2 w-100 justify-content-end gap-2">
                <a href="member_list" class="btn btn-secondary" role="button">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>

</div>