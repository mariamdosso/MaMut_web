<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("config/db.php"); // chemin adapté à ton projet
?>

<div class="container mt-5">
  <div class="card p-4 shadow-lg bg-white rounded-4">
    <h2 class="text-center mb-4">Paiement de la participation</h2>

    <form method="POST" id="paiementForm">
      
      <!-- Choix événement -->
      <div class="mb-3">
        <label for="event" class="form-label">Événement</label>
        <select id="event" name="event_id" class="form-select" required>
          <option value="">-- Sélectionner un événement --</option>
          <?php
          try {
              $events = $pdo->query("SELECT event_id, event_label FROM event ORDER BY event_label ASC");
              while ($row = $events->fetch()) {
                  echo "<option value='{$row['event_id']}'>{$row['event_label']}</option>";
              }
          } catch (Exception $e) {
              echo "<option disabled>⚠️ Erreur : " . htmlspecialchars($e->getMessage()) . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="member" class="form-label">Membre</label>
        <select id="member" name="member_id" class="form-select" required>
          <option value="">-- Sélectionner un membre --</option>
          <?php
          try {
              $members = $pdo->query("SELECT member_id, member_name FROM member ORDER BY member_name ASC");
              while ($row = $members->fetch()) {
                  echo "<option value='{$row['member_id']}'>{$row['member_name']}</option>";
              }
          } catch (Exception $e) {
              echo "<option disabled>⚠️ Erreur : " . htmlspecialchars($e->getMessage()) . "</option>";
          }
          ?>
        </select>
      </div>


      <!-- Montant payé -->
      <div class="mb-3">
        <label for="amount_paid" class="form-label">Montant payé</label>
        <input type="number" class="form-control" name="amount_paid" id="amount_paid" min="1" required>
      </div>

      <!-- Bouton -->
      <div class="d-grid">
        <button type="submit" class="btn btn-success">Valider le paiement ✅</button>
      </div>
    </form>

    <!-- Message retour -->
    <div id="message" class="mt-3"></div>
  </div>
</div>

<!-- jQuery -->
 <script>
// Quand on choisit un événement
$("#event").on("change", function() {
    let eventId = $(this).val();

    if (eventId) {
        $.post("controller/get_payment_info.php", { event_id: eventId }, function(data) {
            let members = JSON.parse(data);
            let options = "<option value=''>-- Sélectionner un membre --</option>";

            if (members.length > 0) {
                members.forEach(function(m) {
                    options += `<option value="${m.member_id}">${m.member_name}</option>`;
                });
                $("#member").html(options);   // 🔹 correspond à ton HTML
            } else {
                $("#member").html('<option value="">Aucun membre trouvé</option>');
            }
        });
    } else {
        $("#member").html('<option value="">-- Sélectionner un membre --</option>');
    }
});
