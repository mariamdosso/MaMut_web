
<?php
// session_start();  

?>
        <div class="text-center mb-4">
            <h1 class="welcome-text">Bienvenue sur MA-MUT 👋</h1>
        </div>
    <div class="container d-flex justify-content-center align-items-center vh-100 bg-info">

        <div class="card p-4 shadow-sm bg-light" style="width: 25rem;">
            <h2 class="text-center mb-4">Connexion</h2>
            <p class="text-danger fw-bold">
               <?php 
               if (isset($_SESSION['message'])) {
    
                echo  $_SESSION['message'];
            
                unset($_SESSION['message']);
            }
               ?>
            </p>
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
 








