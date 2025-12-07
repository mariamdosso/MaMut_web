<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">Créer un compte</h3>
                <h6 class="text-center text-muted mb-4">
                    Pour : <span class="fw-bold text-dark"><?= htmlspecialchars($adherent['full_name']) ?></span>
                </h6>

                <form method="POST" action="/MaMut_web/store_user_account">
                    <input type="hidden" name="adherent_id" value="<?= $adherent['adherent_id'] ?>">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login (ex: email)</label>
                        <input type="text" name="login" id="login" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                👁️
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirm_password')">
                                👁️
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Affecter un ou plusieurs rôle(s)</label>
                        <?php foreach ($roles as $role): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]"
                                    value="<?= $role['id'] ?>" id="role_<?= $role['id'] ?>">
                                <label class="form-check-label" for="role_<?= $role['id'] ?>">
                                    <?= htmlspecialchars($role['label']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="member_list" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Créer le compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>