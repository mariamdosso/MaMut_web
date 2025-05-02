<?php
include("config/db.php");
?>
<div class="container mt-5 w-100 d-flex justify-content-center">
  <div class="card p-4 shadow-sm" style="width: 45rem;">
    <form action="controller/add_event_controller.php" method="POST">
      
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
        <input type="number" name="participation"> Participation requise
      </div>

      <div class="mb-3">
        <input type="date" name="periode"> Périodicité
      </div>
      <div class="mb-3">
        <label class="form-label">Cotisation ?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="cotisation" value="1" onclick="afficherMembres(true)" required>
            <label class="form-check-label">Oui</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="cotisation" value="0" onclick="afficherMembres(false)">
            <label class="form-check-label">Non</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer l'événement</button>
      </div>

      <div >
        <label class="form-label">Membres à cotiser :</label>
      </div> 
      <a href="member_listt?id=<?=$member['member_id'] ?>" class="btn btn-warning btn-sm">selection des membres</a>
    </form>
  </div>
</div>

<!-- JS pour afficher/masquer la liste -->
<!-- <script>
function afficherMembres(afficher) {
  document.getElementById("listeMembres").style.display = afficher ? "block" : "none";
} --
</script> -->
