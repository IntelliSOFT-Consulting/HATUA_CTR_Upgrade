$(function() {
	// Multi Committees 

	$("#addManufacturers").on("click", addManufacturer);
	$(document).on('click', '.removeManufacturer', removeManufacturerData);
	// Multi Dates Handling
	function addManufacturer() {
		var se = $("#Manufacturers .manufacturer-group").last().find('button').attr('id');
		if ( typeof se !== 'undefined' && se !== false && se !== "") {
			intId = parseFloat(se.replace('removeManufacturer', '')) + 1;
		} else {
			intId = 1;
		}
		if ($("#Manufacturers .manufacturer-group").length < 9) {
			// console.log('intId = '+intId);
			var newDate = $('<div class="manufacturer-group"> \
				<div class="control-group"><label class="control-label required">Name of manufacturer</label>\
				<div class="controls"><input name="data[Manufacturer]['+ intId +'][manufacturer_name]" class="input-xxlarge" placeholder=" " type="text" \
				id="Manufacturer'+ intId +'ManufacturerName"></div></div>\
				<div class="control-group"><label class="control-label required">Manufacturing site address</label><div class="controls"><input name="data[Manufacturer]['+ intId +'][address]" \
				class="input-xxlarge" placeholder=" " maxlength="255" type="text" id="Manufacturer'+ intId +'Address"></div></div>\
        <div class="control-group"><label class="control-label required">Manufacturing activities at site</label><div class="controls">\
				<select name="data[Manufacturer]['+ intId +'][manufacturing_activities]" class="input-xlarge" id="Manufacturer'+ intId +'ManufacturingActivities"></select></div></div>\
				<div class="control-group"><label class="control-label">If others, specify</label><div class="controls"><input name="data[Manufacturer]['+ intId +'][other_specify]" \
				class="input-xxlarge" placeholder=" " maxlength="255" type="text" id="Manufacturer'+ intId +'OtherSpecify"></div></div>\
        <div class="control-group"><label class="control-label required">Country of manufacture</label><div class="controls">\
				<select name="data[Manufacturer]['+ intId +'][manufacturer_country]" class="input-xlarge" id="Manufacturer'+ intId +'ManufacturerCountry"></select></div></div>\
        <div class="controls"><button type="button" id="ManufacturerButton{i}" class="btn btn-mini btn-danger removeManufacturer"><i class="icon-trash"></i> Remove Manufacturer</button></div> \
				<hr> </div>');
			$(newDate).find('[name*="manufacturer_country"]').append($("#Manufacturer0ManufacturerCountry > option").clone()).val('');
			$(newDate).find('[name*="manufacturing_activities"]').append($("#Manufacturer0ManufacturingActivities > option").clone()).val('');
			$("#Manufacturers").append(newDate);
		} else {
			alert("Sorry, cant add more than "+$("#Manufacturers .manufacturer-group").length+" manufacturers!");
		}

		$( ".datepickers" ).datepicker({
			minDate:"-100Y", maxDate:"-0D", dateFormat:'dd-mm-yy', showButtonPanel:true, changeMonth:true, changeYear:true,
			buttonImageOnly:true, showAnim:'show', showOn:'both', buttonImage:'/img/calendar.gif'
		});
	}
	function removeManufacturerData() {
		intId = parseFloat($(this).attr('id').replace('removeManufacturer', ''));
		var inputVal = $('#Manufacturer'+ intId +'Id').val();
		if (inputVal) {
			$.ajax({
				type:'POST',
				url:'/manufacturers/delete/'+inputVal+'.json',
				data:{'id': inputVal},
				success : function(data) {
					// console.log(data);
				}
			});
		}
		$(this).parent().parent().parent().remove();
	}
});
