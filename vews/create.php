<?php
include("config/db.php");

$adherents = $pdo->query("SELECT id, full_name, email FROM adherent")->fetchAll();
?>

<div class="text-center mb-4">
    <h1 class="welcome-text">Créer votre compte sur MA-MUT 👋</h1>
</div>

<div class="container d-flex justify-content-center align-items-center vh-100 bg-info">
    <div class="card p-4 shadow-sm bg-light" style="width: 25rem;">
        <h2 class="text-center mb-4">Créer un compte</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="text-danger text-center">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>

        <!-- Ajout de l'appel JS avec onsubmit -->
        <form method="POST" action="controller/create_controller.php" onsubmit="return validateLogin()">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" id="login" name="login" class="form-control" 
                       placeholder="Entrez votre email ou numéro de téléphone" required>
                <small id="loginError" class="text-danger"></small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <input type="text" name="statut" class="form-control" placeholder="Ex: membre, président..." required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="adherent_id" class="form-label">Choisir un adhérent</label>
                <select name="adherent_id" class="form-control" required>
                    <option value="">-- Sélectionnez un adhérent --</option>
                    <?php foreach ($adherents as $adherent): ?>
                        <option value="<?= $adherent['id'] ?>">
                            <?= htmlspecialchars($adherent['full_name']) . " (" . htmlspecialchars($adherent['email']) . ")" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Créer un compte</button>
        </form>

        <div class="text-center mt-3">
            <a href="login">Déjà un compte ? Connectez-vous</a>
        </div>
    </div>
</div>

<script>

function validateLogin() {
    const loginInput = document.getElementById("login").value.trim();
    const errorField = document.getElementById("loginError");

    const phoneRegex = /^(?:\+225)?0[0-9]{9}$/;

    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(loginInput);
    const isPhone = phoneRegex.test(loginInput);

    if (!isEmail && !isPhone) {
        errorField.textContent = "Veuillez entrer un email ou un numéro ivoirien valide (10 chiffres).";
        return false; 
    }

    errorField.textContent = ""; 
    return true;
}
</script>
