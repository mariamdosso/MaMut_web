<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/db.php';
?>
<div class="container d-flex justify-content-center align-items-center vh-100 bg-secondary">
  <div class="card p-4 shadow-lg bg-white rounded-4" style="width: 26rem;"></div>

        <h2>Paiement de la participation</h2>

        <form method="POST" action="controller/paiement_controller.php">
            <select name="event_id">...</select>
            <select name="member_id">...</select>
            <!-- Affichage infos ici via AJAX ou PHP -->
            <input type="number" name="montant_paye" required>
            <button type="submit">Valider le paiement</button>
        </form>

    </div>
</div>
<!-- <script>
$('#member_id').change(function(){
  var event_id = $('#event_id').val();
  var member_id = $(this).val();
  $.ajax({
    url: 'infos_paiement.php',
    method: 'POST',
    data: {event_id: event_id, member_id: member_id},
    success: function(data){
      $('#infos_paiement').html(data);
    }
  });
});
</script> -->