

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 25rem;">
            <h2 class="text-center mb-4">Créer un compte</h2>
            <?php
                session_start();  

                 if (isset($_SESSION['message'])) {
    
                echo '<p>' . $_SESSION['message'] . '</p>';

                unset($_SESSION['message']);
                }
            ?>
            <form method="POST" action="controller/create_controller.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" id="name">
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
                <a href="login">Déjà un compte ? Connectez-vous</a>
            </div>
        </div>
    </div>


