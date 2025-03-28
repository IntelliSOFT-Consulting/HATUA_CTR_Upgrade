$(function () {
    // Multi Drugs Handling
    $("#addDate").on("click", addDate);
    $(document).on('click', '.removeSaeDate', removeSaeDate);

    // Multi Drugs Handling
    function addDate() {
        var se = $("#suspected-drug-date .suspected-group").last().find('button').attr('id');
        if (typeof se !== 'undefined' && se !== false && se !== "") {
            intId = parseFloat(se.replace('suspected_drugsButton', '')) + 1;
        } else {
            intId = 1;
        }
        if ($("#suspected-drug-date .suspected-group").length < 9) {
            var new_suspectdrug = $('<div class="suspected-group">\
    <div class="row-fluid">\
        <div class="span11">\
          <div class="control-group">\
            <label for="SaeDate{i}DateFrom" class="control-label required">Date of initial administration of investigational product  <small class="muted"></small>  <span class="sterix">*</span></label>\
            <div class="controls">\
              <input name="data[SaeDate][{i}][date]" class="datepickers" type="text" id="SaeDate{i}DateFrom">\
            </div>\
          <div class="span1">\
            <div class="controls"><button type="button" id="suspected_drugsButton{i}" class="btn btn-small btn-danger removeSaeDate"><i class="icon-trash"></i></button></div> \
            <hr id="SaeDateHr{i}">\
          </div>\
        </div>\
    </div>\
  </div>\
</div>'.replace(/{i}/g, intId)); 
            $(new_suspectdrug).find('[name*="route_id"]').append($("#SaeLiboso > option").clone()).val('');
            $("#suspected-drug-date").append(new_suspectdrug);
        } else {
            alert("Sorry, cant add more than " + $("#suspected-drug-date .suspected-group").length + " Administration Dates!");
        }

        $(".datepickers").datepicker({
            minDate: "-100Y", maxDate: "-0D", dateFormat: 'dd-mm-yy', showButtonPanel: true, changeMonth: true, changeYear: true,
            yearRange: "-100Y:+0",
            buttonImageOnly: true, showAnim: 'show', showOn: 'both', buttonImage: '/img/calendar.gif'
        });
    }

    function removeSaeDate() {
        intId = parseFloat($(this).attr('id').replace('suspected_drugsButton', ''));

        var inputVal = $('#SaeDate' + intId + 'Id').val();
        if (inputVal) {
            $.ajax({
                type: 'POST',
                url: '/SaeDate/delete/' + inputVal + '.json',
                data: { 'id': inputVal },
                success: function (data) {
                    // console.log(data);
                }
            });
        }
        $(this).closest('div.suspected-group').remove();
    }
});
