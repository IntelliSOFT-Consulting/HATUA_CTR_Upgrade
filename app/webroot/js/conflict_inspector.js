$(function() { 
	enableDisableStatus();
	$('#ActiveInspectorConflictYes').on("click", enableDisableStatus);
	$('#ActiveInspectorConflictNo').on("click", enableDisableStatus);
    function enableDisableStatus() {
		$(".conflictStatus").attr('disabled', 'disabled'); 	
		if($("#ActiveInspectorConflictNo").is(":checked")) {
			$(".conflictStatus").removeAttr('disabled');  
		}
		else if ($("#ActiveInspectorConflictYes").is(":checked")) {
			$(".conflictStatus").attr('disabled', 'disabled'); 
			$(".conflictStatus").prop('checked', false);			 
		}
	}
});