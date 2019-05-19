  $(function() {
    $(document).on('click', '.remove-attachment', remove_attachment);
    var intId = 0;
    var trWrapper = '\
          <div class="row attacho">\
            <div class="span10"><input name="data[SiteInspection][{p}][Attachment][{i}][id]" id="site-inspection-Attachment-{i}-id" type="hidden"> \
                <input name="data[SiteInspection][{p}][Attachment][{i}][file]" id="site-inspection-Attachment-{i}-file" type="file" class="firo"> \
                <input type="hidden" id="site-inspection-{i}-Attachment-{i}-model" value="SiteInspection" name="data[SiteInspection][{p}][Attachment][{i}][model]" style="display: inline;">\
                <input type="hidden" id="site-inspection-{i}-Attachment-{i}-group" value="site_inspections" name="data[SiteInspection][{p}][Attachment][{i}][group]" style="display: inline;">\
                <textarea name="data[SiteInspection][{p}][Attachment][{i}][description]" id="site-inspection-{i}-Attachment-{i}-description" class="flow"\
                          placeholder="descripton" cols="16" rows="1"></textarea> \
            </div>\
            <div class="span2">\
                <br> <button type="button" class="btn btn-default btn-small remove-attachment"><i class="icon-minus"></i></button>\
            </div>\
          </div><hr>\ ';
    $(".addGCPfile").click(function() {
      intId = intId + 1;
      pKey = $(this).val();

      if ($(this).closest('div.uploadsTable').children('div.attacho').length < 7) {            
          trVar = $.parseHTML(trWrapper.replace(/{i}/g, intId).replace(/{p}/g, pKey));
          $(this).closest("div.uploadsTable").append(trVar);
      } else {
          alert("Sorry, can't add more than "+intId+" Attachments at a time!");
      }
    });

    function remove_attachment() {
      $(this).closest('.attacho').remove();        
    }

  });
