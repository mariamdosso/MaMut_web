
<?php
session_start();  

if (isset($_SESSION['message'])) {
    
    echo '<p>' . $_SESSION['message'] . '</p>';

    unset($_SESSION['message']);
}
?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 25rem;">
            <h2 class="text-center mb-4">Connexion</h2>
            <form method="POST" action="controller/login_control.php">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                
            </form>
            <div class="text-center mt-3">
                <a href="register">Créer un compte</a>
            </div>
        </div>
    </div>
 








