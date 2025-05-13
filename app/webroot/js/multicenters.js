//create a autocomplete action for the search box
$(document).ready(function () {
    $("#email").autocomplete({

        source: function (request, response) { 
            $.ajax({
                url: '/users/multi/' + encodeURIComponent(request.term),
                method: 'GET',
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            label: item.User.email,
                            value: item.User.email,
                            id: item.User.id,
                            name: item.User.name
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            $("#email").val(ui.item.value);
            $("#name").val(ui.item.name);
            $("#user_id").val(ui.item.id);
            return false;
        }
    });
    $("#name").autocomplete({

        source: function (request, response) { 
            $.ajax({
                url: '/users/multi/' + encodeURIComponent(request.term),
                method: 'GET',
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.User.name,
                            value: item.User.email,
                            id: item.User.id,
                            name: item.User.name
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            $("#email").val(ui.item.value);
            $("#name").val(ui.item.name);
            $("#user_id").val(ui.item.id);
            return false;
        }
    });
});