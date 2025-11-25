<?php
include("config/db.php");
$user = $_SESSION['user_info'] ?? null;
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg">
                <div class="card-header card-header-custom text-white d-flex align-items-center">
                    <a href="info_user" class="btn btn-warning btn-sm me-3">
                        <i class="bi bi-arrow-left"></i> ANNULER
                    </a>
                    <h3 class="mb-0 ">Modifier mon compte</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="controller/edit_acount_controller.php" novalidate>
                        <div class="mb-3">
                            <label for="login" class="form-label"><i class="bi bi-person"></i> Login</label>
                            <input type="text" name="login" id="login" class="form-control" value="<?= htmlspecialchars($user['login'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="old_password" class="form-label"><i class="bi bi-lock-fill"></i> Ancien mot de passe</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label"><i class="bi bi-key-fill"></i> Nouveau mot de passe</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label"><i class="bi bi-check-circle-fill"></i> Confirmer le nouveau mot de passe</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn-custom  btn-lg">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
