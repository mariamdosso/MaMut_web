<?php
include("config/db.php");
?>
<div class="container mt-5 w-100 d-flex justify-content-center">
    <div class="card p-4 shadow-sm" style="width: 45rem;">
        <h2 class="mb-4">Créer un événement</h2>

        <span id="loading" style="display:none;">⏳ Traitement...</span>

        <form id="eventForm" method="POST" action="controller/add_event_controller.php">
            <div class="mb-3">
                <label class="form-label">Libellé</label>
                <input type="text" name="libelle" id="libelle" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domaine" id="domaine" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Périodicité</label>
                <input type="text" name="periode" id="periode" class="form-control">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="participationCheck" name="has_participation" value="1">
                <label class="form-check-label" for="participationCheck">Participation requise</label>
            </div>

            <div class="mb-3" id="participantsDiv" style="display: none;">
                <label for="participants">Sélectionner les participants :</label>
                <select class="form-control" id="participants" name="membres[]" multiple="multiple" style="width: 100%;">
                    <?php
                    $result = $pdo->query("SELECT member_id, member_name FROM member ORDER BY member_name ASC");
                    while ($row = $result->fetch()) {
                        echo "<option value='{$row['member_id']}'>{$row['member_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">montant</label>
                <input type="number" name="contribution_amount" id="periode" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="eventToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $('#participants').select2({ placeholder: "Choisir les membres", allowClear: true });

    $('#participationCheck').on('change', function() {
        if ($(this).is(':checked')) {
            $('#participantsDiv').slideDown();
        } else {
            $('#participantsDiv').slideUp();
            $('#participants').val(null).trigger('change');
        }
    });

    $('#eventForm').on('submit', function(e) {
        e.preventDefault();
        $("#loading").show();
        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                $("#loading").hide();
                $("#toastBody").text(response.message);

                if (response.success) {
                    $("#eventToast").removeClass("text-bg-danger").addClass("text-bg-success");
                    $('#eventForm')[0].reset();
                    $('#participants').val(null).trigger('change');
                    $('#participantsDiv').hide();
                } else {
                    $("#eventToast").removeClass("text-bg-success").addClass("text-bg-danger");
                }

                var toastEl = document.getElementById('eventToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            },
            error: function() {
                $("#loading").hide();
                $("#toastBody").text("⚠️ Erreur serveur.");
                $("#eventToast").removeClass("text-bg-success").addClass("text-bg-danger");
                var toastEl = document.getElementById('eventToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    });
});
</script>
