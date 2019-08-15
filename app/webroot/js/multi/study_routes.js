$(function() {
	// Multi Routes Handling
	$("#addStudyRoutes").on("click", addStudyRoute);
	$(document).on('click', '.removeStudyRoute', removeStudyRoute);
	// Multi Routes Handling
	function addStudyRoute() {
		var se = $("#StudyRoutes .control-group").last().find('button').attr('id');
		if ( typeof se !== 'undefined' && se !== false && se !== "") {
			intId = parseFloat(se.replace('removeStudyRoute', '')) + 1;
		} else {
			intId = 1;
		}
		if ($("#StudyRoutes .control-group").length < 9) {
			// console.log('intId = '+intId);
			var newRoute = $('<div class="control-group"> <label class="control-label"></label><div class="controls"> \
							<select type="text" id="StudyRoute'+ intId +'StudyRoute" class="input-xlarge" \
							name="data[StudyRoute]['+ intId +'][study_route]"></select><span class="help-inline"> \
							<button title="Remove Route" id="removeStudyRoute'+ intId +'" class="btn btn-mini btn-danger removeStudyRoute" \
							type="button">&nbsp;<i class="icon-trash"></i>&nbsp;</button> Remove Route \
							</span> </div></div>');
			$(newRoute).find('[name*="study_route"]').append($("#StudyRoute0StudyRoute > option").clone()).val('');
			$("#StudyRoutes").append(newRoute);
		} else {
			alert("Sorry, cant add more than "+$("#StudyRoutes .control-group").length+" routes of administration!");
		}


	}
	function removeStudyRoute() {
		intId = parseFloat($(this).attr('id').replace('removeStudyRoute', ''));
		var inputVal = $('#StudyRoute'+ intId +'Id').val();
		if (inputVal) {
			$.ajax({
				type:'POST',
				url:'/study_route/delete/'+inputVal+'.json',
				data:{'id': inputVal},
				success : function(data) {
					// console.log(data);
				}
			});
		}
		$(this).parent().parent().parent().remove();
	}
});
