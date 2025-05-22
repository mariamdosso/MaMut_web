
<div class="container mt-5 w-100 d-flex justify-content-center">
  <div class="card p-4 shadow-sm" style="width: 45rem;">
    <h2>Créer un événement</h2>

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

    <form method="POST" action="controller/add_event_controller.php" class="mt-6">
      <div class="mb-3">
        <label class="form-label">Libellé</label>
        <input type="text" name="libelle" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Type</label>
        <input type="text" name="type" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Domaine</label>
        <input type="text" name="domaine" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Date de début</label>
        <input type="date" name="date_debut" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Date de fin</label>
        <input type="date" name="date_fin" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Périodicité</label>
        <input type="date" name="periode" class="form-control">
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="participationCheck" name="has_participation" value="1">
        <label class="form-check-label" for="participationCheck">Participation requise</label>
      </div>

      <div class="mb-3" id="participantsDiv" style="display: none;">
        <label for="participants">Sélectionner les participants :</label>
        <select class="form-control" id="participants" name="membres[]" multiple="multiple" style="width: 100%;">
          <?php
            $result = $pdo->query("SELECT member_id, member_name FROM member");
            while ($row = $result->fetch()) {
              echo "<option value='{$row['member_id']}'>{$row['member_name']}</option>";
            }
          ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <?php $pdo = null; ?>
  </div>
</div>

<!-- Librairies JS + Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 

 <!-- <link rel="stylesheet" href="assets/css/select2.min.css">
   <script src="assets/js/jquery-3.6.0.min.js" defer> </script>
   <script src="assets/js/select2.min.js" defer> </script> -->

  <script src="assets/js/event.js"></script>