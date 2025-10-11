
    <div class="container mt-5 w-100 d-flex  justify-content-center">
        <div class="card p-4 shadow-sm " style="width: 45rem;">
            <h4 class="text-uppercase fw-bold text-center">Ajouter un nouveau adhérent</h4>
            <h6 class="text-lowercase fw-bold text-center mt-4">veillez renseigner les champs ci dessous</h6>
            
            <?php
                 if (isset($_SESSION['errorMessage'])) {?>
                 <p class=" alert alert-danger fw-bold">

    
              <?= $_SESSION['errorMessage'] ;?>
                </p>
                <?php
                unset($_SESSION['errorMessage']);
                } 
            ?>
            
            
            <?php
                 if (isset($_SESSION['successMessage'])) {?>
                 <p class ="alert alert-success fw-bold">
    
                <?=   $_SESSION['successMessage'] ;?>
                </p>
                <?php

                unset($_SESSION['successMessage']);
                } 
            ?>

            
        <form method="POST" action="controller/add_member_controller.php" class="mt-6">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom complet :</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Mettre le nom complet" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" placeholder="Mettre l'email" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="birth_date" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Date d'adhesion :</label>
                    <input type="date" class="form-control" name="date_of_joining" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre :</label>

                    <input type="radio"  name="gender" value="femme" required>
                    <label for="femme">femme </label>

                    <input type="radio"  name="gender" value="homme" required>
                    <label for="homme">Homme</label>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="city" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Département/Commune :</label>
                    <input type="text" class="form-control" name="municipality_department" required>
                </div>
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="call_number" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="contact" class="form-label">Addresse :</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
            </div>
                <div class=" d-flex p-2 w-100 justify-content-end gap-2  ">
                <a href="member_list" class="btn btn-secondary" role="button">Annuler</a>
                <button type="submit" class="btn btn-primary ">Enregistrer</button>
                </div>
         </form>
       </div>
    </div>
