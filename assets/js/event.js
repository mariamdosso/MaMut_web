$(document).ready(function() {
    $('#participants').select2({
        placeholder: "Choisissez les membres",
        allowClear: true
    });

    $('#participationCheck').on('change', function() {
        if ($(this).is(':checked')) {
            $('#participantsDiv').slideDown();
        } else {
            $('#participantsDiv').slideUp();
            $('#participants').val(null).trigger('change');
        }
    });
});