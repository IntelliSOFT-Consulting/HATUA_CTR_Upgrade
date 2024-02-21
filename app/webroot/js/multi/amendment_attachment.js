$(function () {
    $(document).ajaxStop($.unblockUI);
    $(document).on('click', '.remove-attachment', remove_attachment);
    $(document).on('click', '.save-attachment', save_attachment);
    var intId = 0;
    var trWrapper = '\
    <tr class="attacho">\
        <td>\
            <input name="data[Attachment][{i}][id]" id="attachments-{i}-id" type="hidden"> \
            <input name="data[Attachment][{i}][file]" id="attachments-{i}-file" type="file" class="firo">\
        </td>\
        <td>\
            <input type="hidden" id="attachments-{i}-model" value="Comments" name="data[Attachment][{i}][model]" style="display: inline;">\
            <input type="hidden" id="attachments-{i}-category" value="{n}" name="data[Attachment][{i}][category]" style="display: inline;">\
            <textarea name="data[Attachment][{i}][description]" id="attachments-{i}-description" class="flow span12" placeholder="Description" rows="3"></textarea>\
        </td>\
        <td>\
            <input name="data[Attachment][{i}][version_no]" id="attachments-{i}-version_no" type="text" class="firo span12 input-file version_no" placeholder="Version">\
        </td>\
        <td>\
            <input name="data[Attachment][{i}][file_date]" id="attachments-{i}-file_date" type="date" class="firo span12 input-file pickadate" placeholder="dd-mm-yyyy">\
        </td>\
        <td>\
        <button type="button" class="btn btn-danger remove-attachment tiptip"><i class="icon-minus"></i></button>\
            <button type="button" class="btn btn-primary save-attachment tiptip"><i class="icon-save"></i></button>\
        </td>\
    </tr>';


    // incremental development
    $(".addUploadA").click(function () {
        intId = intId + 1;
        name = $(this).closest('form').find('input[name="model"]').val();

        if ($(this).closest('div.uploadsTableA').children('div.attacho').length < 7) {
            trVar = $.parseHTML(trWrapper.replace(/{i}/g, intId).replace(/{n}/g, name));
            $(this).closest("div.uploadsTableA").append(trVar);
        } else {
            alert("Sorry, can't add more than " + intId + " Attachments at a time!");
        }
    });

    function remove_attachment() {
        $(this).closest('.attacho').remove();
    }

    function save_attachment() {
        var attachmentRow = $(this).closest('.attacho');
        var fileInput = attachmentRow.find('.firo')[0].files[0];
        var description = attachmentRow.find('.flow').val();
        var versionNo = attachmentRow.find('.firo.span12.input-file.version_no').val();
        var fileDate = attachmentRow.find('.firo.span12.input-file.pickadate').val();
    
        // Check if file and description are provided
        if (!fileInput) {
            alert('Please upload a file before saving the attachment.');
            return;
        }
        if (!description.trim()) {
            alert('Please add a description before saving the attachment.');
            return;
        }


        $.blockUI({ css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
          },
          message: '<p class="lead"><span><i class="icon-spinner icon-spin"></i> Please wait... </span></p>'});

    
        // Prepare form data
        var formData = new FormData();
        formData.append('file', fileInput);
        formData.append('description', description);
        formData.append('version_no', versionNo);
        formData.append('file_date', fileDate);
    
        // Send AJAX request
        $.ajax({
            url: '/applicant/attachments/upload.json',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Attachment saved:', response);
                // Handle success response here
                $.unblockUI();
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while saving attachment:', error);
                // Handle error here
                $.unblockUI();
            }
        });
    }

    var maxDate = new Date();
    maxDate.setDate(maxDate.getDate() + 35);

    $(".pickadate").datepicker({
        minDate: "-100Y",
        maxDate: maxDate,
        format: 'dd-mm-yyyy',
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        startDate: '01-01-1990',
        buttonImageOnly: true,
        showAnim: 'show',
        showOn: 'both',
        endDate:maxDate,
        buttonImage: '/img/calendar.gif'
    });

});
