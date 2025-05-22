$(document).ready(function() {
<<<<<<< HEAD

=======
>>>>>>> d5d9bf2 ( alimentation de caisse a parti de participation d'un event)
    $('#participants').select2({
        placeholder: "Choisissez les membres",
        allowClear: true
    });

<<<<<<< HEAD

=======
>>>>>>> d5d9bf2 ( alimentation de caisse a parti de participation d'un event)
    $('#participationCheck').on('change', function() {
        if ($(this).is(':checked')) {
            $('#participantsDiv').slideDown();
        } else {
            $('#participantsDiv').slideUp();
            $('#participants').val(null).trigger('change');
        }
    });
<<<<<<< HEAD

    $('#eventForm').on('submit', function(e) {
        e.preventDefault();

        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).text("Enregistrement...");

        let formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    console.warn(response)
                    alert(response.message);
                    $('#eventForm')[0].reset();
                    $('#participants').val(null).trigger('change');
                    $('#participantsDiv').hide();
                } else {

                    alert("Erreur : " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(error)
                alert("Une erreur est survenue : " + error);
            },
            complete: function() {
                submitButton.prop('disabled', false).text("Ajouter");
            }
        });
    });
=======
>>>>>>> d5d9bf2 ( alimentation de caisse a parti de participation d'un event)
});