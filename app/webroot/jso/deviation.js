$(function () {


	$('.deviation_type').click(function () {
        if ($(this).val() == 'Deviation') {
            $('.deviation_type_dev').attr('disabled', this.checked).attr('checked', !this.checked);
        } else {
            $('.deviation_type_dev').attr('disabled', false);
        }
    });
    if ($('.deviation_type[value="Deviation"]').is(':checked')) { $('.deviation_type_dev').attr('disabled', true).attr('checked', false); }

});