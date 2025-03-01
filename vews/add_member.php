
    <div class="container mt-5 w-100 d-flex  justify-content-center">
        <div class="card p-4 shadow-sm " style="width: 45rem;">
            <h4 class="text-uppercase fw-bold text-center"> NOUVEAU MEMBRE </h4>
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
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Date d'adhesion :</label>
                    <input type="date" class="form-control" name="date_adhesion" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre :</label>

                    <input type="radio"  name="genre" value="femme" required>
                    <label for="femme">femme </label>

                    <input type="radio"  name="genre" value="homme" required>
                    <label for="homme">Homme</label>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Commune :</label>
                    <input type="text" class="form-control" name="commune" required>
                </div>
                <div class="col-md-6">
                    <label for="quartier" class="form-label">Quartier :</label>
                    <input type="text" class="form-control" name="quartier" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="contact" required>
                </div>
                <div class="col-md-6">
                    <label for="profession" class="form-label">Profession :</label>
                    <input type="text" class="form-control" name="profession" required>
                </div>
            </div>

            <div class="row mb-3 ">
                <div class="col-md-6 ">
                    <label for="role" class="form-label ">fonction :</label>
                        <select id="fonction" name="fonction" required class="form-select">
                            <option value="president">Membre</option>
                            <option value="president">President</option>
                            <option value="president">Secretaire generale</option>
                            <option value="vice president">Vice President</option>
                            <option value="tresorier">Tresorier</option>
                            <option value="secretaire">Secretaire</option>
                            <option value="autre">Autre</option>
                        </select>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
                <div class=" d-flex p-2 w-100 justify-content-center  ">
                <button type="submit" class="btn btn-primary ">Ajouter</button>
                </div>
         </form>
       </div>
    </div>
