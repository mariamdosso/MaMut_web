
<?php include("config/db.php"); ?>

<div class="container mt-5 w-100 d-flex justify-content-center">
  <div class="card p-4 shadow-sm" style="width: 45rem;">
    <h2>Créer un événement</h2>

    <div id="messageBox"></div> <!-- Zone pour afficher les messages -->

    <form id="eventForm" method="POST" action="controller/add_event_controller.php">
      <div class="mb-3">
        <label class="form-label">Libellé</label>
        <input type="text" name="libelle" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Type</label>
          <select name="event_type" id="event_type">
            <option value="Réunion"></option>
            <option value="Collecte">Collecte</option>
            <option value="Assemblée">Assemblée</option>
          </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Domaine</label>
        <select name="event_type" id="event_type">
            <option value="Réunion">Réunion</option>
            <option value="Collecte">Collecte</option>
            <option value="Assemblée">Assemblée</option>
          </select>
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
        <select name="event_periodicity" id="event_type">
            <option value="Réunion">Temporaire</option>
            <option value="Collecte">Permanent</option>
          </select>
      </div>
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

            <button type="submit" class="btn btn-primary">ajouter</button>
        </form>
        <?php $pdo = null; ?>
        </div>
    </div>

