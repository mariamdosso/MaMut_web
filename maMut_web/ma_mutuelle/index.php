<?php
session_start();
require "./config/db.php"; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$email) {
        $_SESSION['error'] = "Email invalide.";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Vérifier si l'email existe déjà
        $query = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $query->execute([$email]);

        if ($query->rowCount() > 0) {
            $_SESSION['error'] = "Cet e-mail est déjà enregistré.";
        } else {
            try {
                // Correction de la requête INSERT avec les bons placeholders
                $query = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
                $query->execute([$name, $email, $hashed_password]);

                $_SESSION['success'] = "Compte créé avec succès.";
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erreur SQL : " . $e->getMessage();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 25rem;">
            <h2 class="text-center mb-4">Créer un compte</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Créer un compte</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">Déjà un compte ? Connectez-vous</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    require " ma_mutuelle/login.php" ;
    require " ma_mutuelle/tableau_bord.php" ;
    ?>
