
<div class="background-image">
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100"> 
            <!--begin::Image-->                
            <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/images/social.png" alt="">    
            <!--end::Image-->

            <!--begin::Title-->
            <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7"> 
                rapide, efficace et productif
            </h1>  
            <!--end::Title-->

            <!--begin::Text-->
            <div class="text-gray-600 fs-base text-center fw-semibold">
                Connectez-vous pour gérer vos membres et cotisations facilement,  

                et optimisez votre association dès aujourd’hui !  <br> 
                
            </div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--begin::Aside-->

    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                    
<!--begin::Form-->
<?php
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-danger text-center mb-4" role="alert">'
        . htmlspecialchars($_SESSION['message']) .
        '</div>';
    unset($_SESSION['message']);
}
?>
<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_sign_in_form"  action="controller/login_control.php" method="post">
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">
            Se connecter
        </h1>
        <!--end::Title-->

        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">
           Appartenez a une association
        </div>
        <!--end::Subtitle--->
    </div>
    <!--begin::Heading-->

    <!--begin::Login options-->
    <!-- <div class="row g-3 mb-3">
        
        <div class="col-md-12">
        </div>
 
        </div>
        
    </div>
    

    <!--begin::Input group--->
    <div class="fv-row mb-8 fv-plugins-icon-container">
        <!--begin::Email-->
        <input type="text" placeholder="Email ou numero de telephone" name="login" autocomplete="off" class="form-control bg-transparent"> 
        <!--end::Email-->
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

    <!--end::Input group--->
    <div class="fv-row mb-3 fv-plugins-icon-container">    
        <!--begin::Password-->
        <input type="password" placeholder="Password" name="password"  id="password" autocomplete="off" class="form-control bg-transparent">
        <!--end::Password-->
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
    <!--end::Input group--->

    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <div></div>

        <!--begin::Link-->
        <a href="/metronic8/demo6/authentication/layouts/overlay/reset-password.html" class="link-primary">
            Mot de passe oublier ?
        </a>
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->    

    <!--begin::Submit button-->
            
<div class="d-grid mb-10">
    <button type="submit" id="kt_sign_in_submit" class="btn login-button">
        Connectez-vous
    </button>
</div>

    <!--end::Submit button-->

    <!--begin::Sign up-->

</form>

</div>

<script>
function togglePassword() {
  const input = document.getElementById("password");
  input.type = input.type === "password" ? "text" : "password";
}
