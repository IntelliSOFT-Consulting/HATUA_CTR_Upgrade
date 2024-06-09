$(function () {
    $(document).ajaxStop($.unblockUI);
    $(document).on('click', '.save-attachment', save_attachment);

    function save_attachment() {

        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            },
            message: '<p class="lead"><span><i class="icon-spinner icon-spin"></i> Please wait... </span></p>'
        });


        // const myHeaders = new Headers();
        // myHeaders.append("APPID", "c4ca4238a0b923820dcc509a6f75849b");
        // myHeaders.append("APIKEY", "YzM4ZWRhMTMwNzViMGJjZDJiMGVkNjkzOWRlNzFmMDhkZTA2YTUzNA==");
        // myHeaders.append("Cookie", "PHPSESSID=u2pofluhs9dfmbpngtt51pcbhc");

        // const requestOptions = {
        //     method: "GET",
        //     headers: myHeaders,
        //     redirect: "follow"
        // };

        // fetch("https://invoices.pharmacyboardkenya.org/token", requestOptions)
        //     .then((response) => response.text())
        //     .then((result) => console.log(result))
        //     .catch((error) => console.error(error));
        //   var settings = {
        //     "url": "https://invoices.pharmacyboardkenya.org/token",
        //     "method": "GET",
        //     "timeout": 0,
        //     "headers": {
        //       "APPID": "c4ca4238a0b923820dcc509a6f75849b",
        //       "APIKEY": "YzM4ZWRhMTMwNzViMGJjZDJiMGVkNjkzOWRlNzFmMDhkZTA2YTUzNA==",
        //       "Cookie": "PHPSESSID=u2pofluhs9dfmbpngtt51pcbhc"
        //     },
        //   };

        //   $.ajax(settings).done(function (response) {
        //     console.log(response);
        //     $.unblockUI();
        //   });

        // Prepare form data
        var formData = new FormData();

        // // Send AJAX request
        // $.ajax({
        //     url: 'https://invoices.pharmacyboardkenya.org/token',
        //     type: 'GET',
        //     // data: formData,
        //     headers: {
        //         'APPID': 'c4ca4238a0b923820dcc509a6f75849b',
        //         'APIKEY':'YzM4ZWRhMTMwNzViMGJjZDJiMGVkNjkzOWRlNzFmMDhkZTA2YTUzNA=='
        //         // Add any other headers you need
        //     },
        //     processData: false,
        //     contentType: false,
        //     success: function(response) {
        //         console.log('API Response :', response);
        //         // Handle success response here
        //         $.unblockUI();
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Error Retrieving Token', error);
        //         // Handle error here
        //         $.unblockUI();
        //     }
        // });
    }

});
