$(function() {
    // Multi Drugs Handling
    $("#addConcomittantDrug").on("click", addConcomittantDrugs);
    $(document).on('click', '.removeConcomittantDrug', removeConcomittantDrug);

    // Multi Drugs Handling
    function addConcomittantDrugs() {
        var se = $("#concomittant-drugs .concomittant-group").last().find('button').attr('id');
        if ( typeof se !== 'undefined' && se !== false && se !== "") {
            intId = parseFloat(se.replace('concomittant_drugsButton', '')) + 1;
        } else {
            intId = 1;
        }
        if ($("#concomittant-drugs .concomittant-group").length < 9) {
            var new_concomittantdrug = $('<div class="concomittant-group">\
    <div class="row-fluid">\
        <div class="span6">\
          <input type="hidden" name="data[ConcomittantDrug][{i}][id]" class="" id="ConcomittantDrug{i}Id">\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}GenericName" class="control-label required">Generic Name <span class="sterix">*</span></label>\
            <div class="controls">\
              <input name="data[ConcomittantDrug][{i}][generic_name]" class="" maxlength="100" type="text" id="ConcomittantDrug{i}GenericName">\
            </div>\
          </div>\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}Dose" class="control-label required">Dose <span class="sterix">*</span></label>\
            <div class="controls">\
              <input name="data[ConcomittantDrug][{i}][dose]" class="" maxlength="100" type="text" id="ConcomittantDrug{i}Dose">\
            </div>\
          </div>\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}RouteId" class="control-label required">Administration Route <span class="sterix">*</span></label>\
            <div class="controls">\
              <select name="data[ConcomittantDrug][{i}][route_id]" class="" id="ConcomittantDrug{i}RouteId">\
              </select>\
            </div>\
          </div>\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}Indication" class="control-label required">Indication for use <span class="sterix">*</span></label>\
            <div class="controls">\
              <input name="data[ConcomittantDrug][{i}][indication]" class="" maxlength="255" type="text" id="ConcomittantDrug{i}Indication">\
            </div>\
          </div>\
        </div>\
        <div class="span6">\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}DateFrom" class="control-label required">Date <small class="muted">(from)</small>  <span class="sterix">*</span></label>\
            <div class="controls">\
              <input name="data[ConcomittantDrug][{i}][date_from]" class="datepickers" type="text" id="ConcomittantDrug{i}DateFrom">\
            </div>\
          </div>\
          <div class="control-group">\
            <label for="ConcomittantDrug{i}DateTo" class="control-label required">Date <small class="muted">(to)</small> </label>\
            <div class="controls">\
              <input name="data[ConcomittantDrug][{i}][date_to]" class="datepickers" type="text" id="ConcomittantDrug{i}DateTo">\
            </div>\
          </div>\
        </div>\
        <div class="row-fluid">\
          <div class="span12">\
            <div class="controls"><button type="button" id="concomittant_drugsButton{i}" class="btn btn-small btn-danger removeConcomittantDrug"><i class="icon-trash"></i> Remove Concomittant Drug</button></div> \
            <hr id="ConcomittantDrugHr{i}">\
          </div>\
        </div>\
    </div>\
  </div>\
</div>'.replace(/{i}/g, intId));
            // console.log(se.replace(/\d/, '1441441'));
            $(new_concomittantdrug).find('[name*="route_id"]').append($("#SuspectedDrug0RouteId > option").clone()).val('');
            $("#concomittant-drugs").append(new_concomittantdrug);
        } else {
            alert("Sorry, cant add more than "+$("#concomittant-drugs .concomittant-group").length+" Suspected Drugs!");
        }

        $( ".datepickers" ).datepicker({
            minDate:"-100Y", maxDate:"-0D", dateFormat:'dd-mm-yy', showButtonPanel:true, changeMonth:true, changeYear:true,
            yearRange: "-100Y:+0",
            buttonImageOnly:true, showAnim:'show', showOn:'both', buttonImage:'/img/calendar.gif'
        });
    }

    function removeConcomittantDrug() {
        intId = parseFloat($(this).attr('id').replace('concomittant_drugsButton', ''));
        
        var inputVal = $('#ConcomittantDrug'+ intId +'Id').val();
        if (inputVal) {
            $.ajax({
                type:'POST',
                url:'/concomittant_drugs/delete/'+inputVal+'.json',
                data:{'id': inputVal},
                success : function(data) {
                    // console.log(data);
                }
            });
        }
        $(this).closest('div.concomittant-group').remove();
    }
});
