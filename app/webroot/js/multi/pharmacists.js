$(function() {
    // Multi Contacts Handling
    $("#addPharmacist").on("click", addPharmacists);
    $(document).on('click', '.removePharmacist', removePharmacist);

    // Multi Contacts Handling
    function addPharmacists() {
        var se = $("#pharmacist_contacts .pharmacist-group").last().find('button').attr('id');
        if ( typeof se !== 'undefined' && se !== false && se !== "") {
            intId = parseFloat(se.replace('PharmacistButton', '')) + 1;
        } else {
            intId = 1;
        }
        if ($("#pharmacist_contacts .pharmacist-group").length < 9) {
            var new_picontact = $('<div class="pharmacist-group"> \
                       <div class="control-group"><label for="Pharmacist{i}RegNo" class="control-label required">Registration Number <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][reg_no]" class="input-xxlarge" maxlength="100" type="text" id="Pharmacist{i}RegNo"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}GivenName" class="control-label required">Name <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][given_name]" class="input-xxlarge"  maxlength="100" type="text" id="Pharmacist{i}GivenName"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}ValidYear" class="control-label required">Valid year <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][valid_year]" class="input-xxlarge"  maxlength="10" type="text" id="Pharmacist{i}ValidYear"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}Qualification" class="control-label required">Qualification <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][qualification]" class="input-xxlarge"  maxlength="255" type="text" id="Pharmacist{i}Qualification"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}PremiseName" class="control-label required">Premise</label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][premise_name]" class="input-xxlarge" placeholder=" " maxlength="200" type="text" id="Pharmacist{i}PremiseName"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}ProfessionalAddress" class="control-label required">Physical address <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][professional_address]" class="input-xxlarge" maxlength="255" type="text" id="Pharmacist{i}ProfessionalAddress"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}Telephone" class="control-label required">Telephone number</label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][telephone]" class="input-xxlarge" placeholder=" " maxlength="100" type="text" id="Pharmacist{i}Telephone"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}Mobile" class="control-label required">Mobile number</label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][mobile]" class="input-xxlarge" placeholder=" " maxlength="100" type="text" id="Pharmacist{i}Mobile"></div></div>\
                       <div class="control-group"><label for="Pharmacist{i}Email" class="control-label required">email address <span class="sterix">*</span></label>\
                        <div class="controls"><input name="data[Pharmacist][{i}][email]" class="input-xxlarge" placeholder=" " type="email" id="Pharmacist{i}Email"></div></div>  \
                       <div class="controls"><button type="button" id="PharmacistButton{i}" class="btn btn-mini btn-danger removePharmacist"><i class="icon-trash"></i> Remove Pharmacist</button></div> \
                        <hr id="PharmacistHr{i}"> </div>'.replace(/{i}/g, intId));
            // console.log(se.replace(/\d/, '1441441'));
            $("#pharmacist_contacts").append(new_picontact);
        } else {
            alert("Sorry, cant add more than "+$("#pharmacist_contacts .pharmacist-group").length+" Contacts!");
        }

        regAutocomplete(intId);
    }

    regAutocomplete(0);

    function regAutocomplete(intId = 0) {
        //on focusout
        reg = $('#Pharmacist'+intId+'RegNo');
        // console.log(reg);
        reg.focusout(function() {
            $.ajax({
               url: "/pharmacists/fetch/"+reg.val()+".json",
               type: "POST",
               dataType: "json",
               data:{'reg_no': reg.val()},
               success: function( data ) {
                    vals = returnedData = JSON.parse(data);
                    $('#Pharmacist'+intId+'GivenName').val(vals.Superitendant);
                    $('#Pharmacist'+intId+'ValidYear').val(vals.ValidYear);
                    $('#Pharmacist'+intId+'Qualification').val(vals["Superitendant Cadre"]);
                    $('#Pharmacist'+intId+'PremiseName').val(vals.PremiseName);
                    $('#Pharmacist'+intId+'ProfessionalAddress').val(vals.PremisePhysicalAddress);
                    $('#Pharmacist'+intId+'Telephone').val(vals.SupNumber);
                    $('#Pharmacist'+intId+'Mobile').val(vals.PremiseMobile);
                    $('#Pharmacist'+intId+'Email').val(vals.SupEmail);
               }
            });
        });
    }

    function removePharmacist() {
        intId = parseFloat($(this).attr('id').replace('PharmacistButton', ''));
        var inputVal = $('#Pharmacist'+ intId +'Id').val();
        if (inputVal) {
            $.ajax({
                type:'POST',
                url:'/pharmacists/delete/'+inputVal+'.json',
                data:{'id': inputVal},
                success : function(data) {
                    console.log(data);
                }
            });
        }
        $(this).parent().parent().remove();

    }
});


/*regAutocomplete(0);
    function regAutocomplete(intId = 0) {
        reg = $('#Pharmacist'+intId+'RegNo');
        console.log(reg);
        reg.autocomplete({
            source: function( request, response ) {
            $.ajax({
               url: "https://rhris.pharmacyboardkenya.org/api_version/getPremise/PHARMACIST/"+request.term,
               type: "GET",
               dataType: "jsonp",
               // data: {
               //    q: request.term
               // },
               beforeSend: function(xhr){xhr.setRequestHeader('x-api-key', 'Hg.Vb*BFYv{1OOx<#]ZK$1kv-3&KywL=$LdmBaj1:%{[Y/dknfa/SD+ORAs<cy_P');},
               success: function( data ) {
                    console.log(data);
                   response($.map(data, function(item) {
                         return {
                             label : item.label,
                             value : item.value
                         };
                   }));
               }
            });
           },
            select: function( event, ui ) {
                console.log(ui);
                reg.val( ui.item.label );
                return false;
            }
        });
    }*/