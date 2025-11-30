$(document).ready(function() {

    $('#participants').select2({
        placeholder: "Choisir les membres",
        allowClear: true
    });

    //
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


        if ($('#libelle').val().trim() === "") {
            alert("Veuillez entrer le libellé.");
            $("#loading").hide();
            return;
        }

        $.ajax({
            url: "controller/add_event_controller.php",
            method: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                $("#loading").hide();

                
                $("#toastBody").text(response.message);

                if (response.success) {
                    $("#eventToast").removeClass("text-bg-danger").addClass("text-bg-success");
                } else {
                    $("#eventToast").removeClass("text-bg-success").addClass("text-bg-danger");
                }


                var toastEl = document.getElementById('eventToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

               
                if (response.success) {
                    $('#eventForm')[0].reset();
                    $('#participants').val(null).trigger('change');
                    $('#participantsDiv').hide();
                }
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