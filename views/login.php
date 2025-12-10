<div class="background-image">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="/assets/images/social.png" alt="">
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                   Gérez votre association simplement, efficacement.
                </h1>
                <div class="text-gray-500 fs-base text-center fw-semibold">
                    MaMut est la plateforme moderne pour suivre vos membres, cotisations et activités — en toute simplicité. <br>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                        <?php
                        if (!empty($_SESSION['message'])) {
                            echo '<div class="alert alert-danger text-center mb-4" role="alert">'
                                . htmlspecialchars($_SESSION['message']) .
                                '</div>';
                            unset($_SESSION['message']);
                        }
                        ?>
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_sign_in_form" action="/MaMut_web/login" method="post">
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    Se connecter
                                </h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                   Accédez à votre espace de gestion
                                </div>
                            </div>
                            <div class="fv-row mb-8 fv-plugins-icon-container">
                                <input type="text" placeholder="Email ou numero de telephone" name="login" autocomplete="off" class="form-control bg-transparent">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>

                            <div class="mb-3 position-relative">
                                <input 
                                    type="password" 
                                    class="form-control bg-transparent" 
                                    id="password"
                                    name="password"
                                   placeholder="Mot de passe"
                                >

                                <!-- Icône œil Bootstrap -->
                                <span 
                                    class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    onclick="togglePassword()" 
                                    style="cursor:pointer;"
                                >
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </span>
                            </div>

                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="/metronic8/demo6/authentication/layouts/overlay/reset-password.html" class="link-primary-login">
                                   Mot de passe oublié ?
                                </a>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn login-button">
                                    Connectez-vous
                                </button>
                            </div>
                        </form>

                    </div>

                    <script>
                        function togglePassword() {
                            const input = document.getElementById("password");
                            const icon = document.getElementById("toggleIcon");

                            if (input.type === "password") {
                                input.type = "text";
                                icon.classList.remove("bi-eye");
                                icon.classList.add("bi-eye-slash");
                            } else {
                                input.type = "password";
                                icon.classList.remove("bi-eye-slash");
                                icon.classList.add("bi-eye");
                            }
                        }
                    </script>
