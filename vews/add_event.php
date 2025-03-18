
<div class="container mt-5 w-100 d-flex  justify-content-center">
<div class="card p-4 shadow-sm " style="width: 45rem;">
        <h2>creer un événement</h2>

        <?php
                 if (isset($_SESSION['errorMessage'])) {?>
                 <p class=" alert alert-danger fw-bold">

    
              <?= $_SESSION['errorMessage'] ;?>
                </p>
                <?php
                unset($_SESSION['errorMessage']);
                } 
            ?>
            <?Php 
            var_dump($_SERVER["REQUEST_URI"] );
            var_dump(__DIR__);
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

            

        <form method="POST" action="controller/add_event_controller.php" class="mt-6">
            <div class="mb-3">
                <label class="form-label">Libellé</label>
                <input type="text" name="libelle" class="form-control" required >
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" required?>
            </div>
            <div class="mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domaine" class="form-control" required >
            </div>
            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" class="form-control" required >
            </div>
            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" required >
            </div>
            <div class="mb-3">
                <input type="number" name="participation" > Participation requise
            </div>

            <div class="mb-3">
                <input type="date" name="periode" > Periodicite
            </div>
            <button type="submit" class="btn btn-primary">ajouter</button>
        </form>
        </div>
    </div>

