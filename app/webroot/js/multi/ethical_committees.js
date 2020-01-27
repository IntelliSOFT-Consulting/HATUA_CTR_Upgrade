$(function() {
	// Multi Committees 

	$("#addEthicalCommittees").on("click", addEthicalCommittee);
	$(document).on('click', '.removeEthicalCommittee', removeEthicalDate);
	// Multi Dates Handling
	function addEthicalCommittee() {
		var se = $("#EthicalCommittees .ethical-group").last().find('button').attr('id');
		if ( typeof se !== 'undefined' && se !== false && se !== "") {
			intId = parseFloat(se.replace('removeEthical', '')) + 1;
		} else {
			intId = 1;
		}
		if ($("#EthicalCommittees .ethical-group").length < 9) {
			// console.log('intId = '+intId);
			var newDate = $('<div class="ethical-group"> \
        <div class="control-group"><label class="control-label required">Name of Ethics Review Committee (ERC)</label><div class="controls">\
				<select name="data[EthicalCommittee]['+ intId +'][ethical_committee]" class="input-xxlarge" id="EthicalCommittee'+ intId +'EthicalCommittee"></select></div></div>\
				<div class="control-group"><label class="control-label required">Date of initial complete submission to ERC</label>\
				<div class="controls"><input name="data[EthicalCommittee]['+ intId +'][submission_date]" class="datepickers" placeholder=" " type="text" \
				id="EthicalCommittee'+ intId +'SubmissionDate"></div></div>\
				<div class="control-group"><label class="control-label required">ERC Number</label><div class="controls"><input name="data[EthicalCommittee]['+ intId +'][erc_number]" \
				class="input-xxlarge" placeholder=" " maxlength="55" type="text" id="EthicalCommittee'+ intId +'ErcNumber"></div></div>\
				<div class="control-group" id="EthicalCommittee'+ intId +']"><label class="control-label">Approval date by ERC</label><div class="controls"><input name="data[EthicalCommittee]['+ intId +'][initial_approval]"\
         class="datepickers" type="text" id="EthicalCommittee'+ intId +']InitialApproval"><span class="help-inline">  </span> </div></div>\
        <div class="controls"><button type="button" id="EthicalCommitteeButton{i}" class="btn btn-mini btn-danger removeEthicalCommittee"><i class="icon-trash"></i> Remove Ethical Committee</button></div> \
				<hr> </div>');
			$(newDate).find('[name*="ethical_committee"]').append($("#EthicalCommittee0EthicalCommittee > option").clone()).val('');
			$("#EthicalCommittees").append(newDate);
		} else {
			alert("Sorry, cant add more than "+$("#EthicalCommittees .ethical-group").length+" ethical committees!");
		}

		$( ".datepickers" ).datepicker({
			minDate:"-100Y", maxDate:"-0D", dateFormat:'dd-mm-yy', showButtonPanel:true, changeMonth:true, changeYear:true,
			buttonImageOnly:true, showAnim:'show', showOn:'both', buttonImage:'/img/calendar.gif'
		});
	}
	function removeEthicalDate() {
		intId = parseFloat($(this).attr('id').replace('removeEthical', ''));
		var inputVal = $('#EthicalCommittee'+ intId +'Id').val();
		if (inputVal) {
			$.ajax({
				type:'POST',
				url:'/ethical_committees/delete/'+inputVal+'.json',
				data:{'id': inputVal},
				success : function(data) {
					// console.log(data);
				}
			});
		}
		$(this).parent().parent().parent().remove();
	}
});
