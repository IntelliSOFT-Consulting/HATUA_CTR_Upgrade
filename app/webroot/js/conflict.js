$(function() { 
	enableDisableStatus();
	$('#ReviewConflictYes').on("click", enableDisableStatus);
	$('#ReviewConflictNo').on("click", enableDisableStatus);
    function enableDisableStatus() {
		$(".conflictStatus").attr('disabled', 'disabled'); 	
		if($("#ReviewConflictNo").is(":checked")) {
			$(".conflictStatus").removeAttr('disabled');  
		}
		else if ($("#ReviewConflictYes").is(":checked")) {
			$(".conflictStatus").attr('disabled', 'disabled'); 
			$(".conflictStatus").prop('checked', false);			 
		}
	}
});