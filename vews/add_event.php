
<div class="container mt-5 w-100 d-flex  justify-content-center">
<div class="card p-4 shadow-sm " style="width: 45rem;">
        <h2>creer un événement</h2>

        <?php

        include("config/db.php");
        $result = $pdo->query("SELECT * FROM member");
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
                <input type="date" name="periode" > Periodicite
            </div>
            <div class="mb-3">
                <input type="number" name="participation" > Participation requise
            </div>

                <label>Sélectionner les membres :</label><br>

                <?php
                $result = $pdo->query("SELECT member_id, member_name FROM member");
                while ($row = $result->fetch()) {
                    echo "
                    <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='membres[]' value='{$row['member_id']}' id='membre{$row['member_id']}'>
                    <label class='form-check-label' for='membre{$row['member_id']}'>
                        {$row['member_name']}
                    </label>
                    </div>
                    ";
                }
                ?>
                <br><br>

            <!-- <div class="mb-3">
                <label class="form-label">Cotisation ?</label>
                    <div>
                        <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="cotisation" id="cotisationOui" value="1" required onclick="afficherMembres(true)">
                <label class="form-check-label" for="cotisationOui">Oui</label>
                    </div>
                        <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="cotisation" id="cotisationNon" value="0" onclick="afficherMembres(false)">
                <label class="form-check-label" for="cotisationNon">Non</label>
                     </div>
                         </div>
            </div> -->

            <button type="submit" class="btn btn-primary">ajouter</button>
        </form>
        <?php $pdo = null; ?>
        </div>
    </div>

