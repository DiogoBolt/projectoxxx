$(function() {

    $("#available_until").datepicker({dateFormat: 'yy-mm-dd'});
    $("#available_from").datepicker({dateFormat: 'yy-mm-dd'});

    $(".nav-tabs-custom .nav-tabs li a").click(function () {
        $("#bonus_type_id").val($(this).prop("id"));

        setBonusView();
    }).parent()
        .removeClass("active");

    $("#" + $("#bonus_type_id").val())
        .parent()
        .addClass("active");


    function setBonusView()
    {
        var bonusType = $("#bonus_type_id").val();
        var valueOrigin = $("#value_origin");

        switch (bonusType) {
            case 'first_deposit':
            case 'casino_deposit':
                valueOrigin.html("% deposit");
                break;
            case 'first_bet':
                valueOrigin.html("% bet amount");
                break;
            case 'casino_no_deposit':
                valueOrigin.html("€ amount");
                break;
        }
    }

    setBonusView();

    $("#addUserBtn").click(function(e) {
        e.preventDefault();
        var userName = $("#userText").val();
        if (userName) {
            addUser(userName);

            $("#userText").val("");
        }

    });

    $("#userText").autocomplete({
        source: "/bonus/get_users",
        minLength: 1
    });

    function addUser(userName, init) {
        init = (typeof (init) === 'undefined')?false:init;
        var users = $("#username_targets");
        if (!init) {
            if (users.find("option[value='" + userName + "']").length) return;
            users.append($("<option></option>").prop('selected', true).prop("value", userName).text(userName));
        }
        $("#usersContainer").append(
            '<div style="float: left; margin: 5px; padding: 0 10px; background-color: #f4f4f4; color: #444;">' +
            userName +
            '<a id="remove-'+userName.replace(/\s+/g, '-')+'" data-userName="' + userName + '" class="removeFiltro" title="Remove" href="javascript:">' +
            '<i style="color:#F00" class="fa fa-times"></i>' +
            '</a>' +
            '</div>'
        );

        $("#remove-"+userName.replace(/\s+/g, '-')).click(removeUser);
    }

    function removeUser(e) {
        e.preventDefault();
        var userName = $(this).data("username");
        $("#username_targets").find("option[value='"+userName+"']")[0].remove();
        $(this).parent().remove();

    }

    (function() {
        var users = $("#username_targets").find("option");
        $.each(users, function(index, option) {
            addUser(option.value, true);
        })
    })();

    $("#selectAllTargets").click(function (e) {
        e.preventDefault();
        $("input[name=targets\\[\\]]").prop('checked', true);
    });

    $("#clearTargets").click(function (e) {
        e.preventDefault();
        $("input[name=targets\\[\\]]").prop('checked', false);
    });

    $("#selectAllCasinoGames").click(function (e) {
        e.preventDefault();
        $("input[name=casino_games\\[\\]]").prop('checked', true);
    });

    $("#clearCasinoGames").click(function (e) {
        e.preventDefault();
        $("input[name=casino_games\\[\\]]").prop('checked', false);
    });
});

