<div class="container d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="card p-4 shadow-lg border-0" style="width: 26rem;">
    <div class="text-center mb-4">
      <h3 class="fw-bold text-primary">Bienvenue sur MA-MUT 👋</h3>
    </div>
    <h4 class="text-center mb-3 text-secondary">Connexion</h4>
    <p class="text-danger fw-semibold text-center">
      <?php 
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
      ?>
    </p>
    <form method="POST" action="controller/login_control.php">
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input 
          type="text" 
          name="login" 
          class="form-control rounded-3" 
          id="login" 
          placeholder="Entrez votre email ou numéro de téléphone" 
          required>
      </div>
      <div class="mb-3 position-relative">
        <label for="password" class="form-label">Mot de passe</label>
        <input 
          type="password" 
          name="password" 
          class="form-control rounded-3" 
          id="password" 
          placeholder="Entrez votre mot de passe" 
          required>
        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword()">
          👁️
        </button>
      </div>
      <button type="submit" class="btn btn-primary w-100 rounded-3">Se connecter</button>
    </form>
    <!-- <div class="text-center mt-3">
      <a href="register" class="text-decoration-none">Créer un compte</a>
    </div> -->
  </div>
</div>

<script>
function togglePassword() {
  const passwordInput = document.getElementById("password");
  passwordInput.type = passwordInput.type === "password" ? "text" : "password";
}
</script>
