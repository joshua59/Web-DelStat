function text_only(obj) {
    $('#' + obj).bind('keypress', function (event) {
        var regex = new RegExp("^[A-Z a-z 0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
}

function username(obj) {
    $('#' + obj).bind('keypress', function (event) {
        var regex = new RegExp("^[A-Za-z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
}
function jam(obj) {
    $('#' + obj).bind('keypress', function (event) {
        var regex = new RegExp("^[:0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
}

function number_only(obj) {
    $('#' + obj).bind('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
}

function format_email(obj) {
    $('#' + obj).bind('keyup', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        var iddataerror = $(this).data("id-error");
        var classdataerror = $(this).data("class-error");
        if (!regex.test(key)) {
            $("." + classdataerror).html("Email Invalid");
            $("#" + iddataerror).html("Email Invalid");
        } else {
            $("." + classdataerror).html("");
            $("#" + iddataerror).html("");
        }
    });
}
function ribuan(obj) {
    $('#' + obj).keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
        var id = $(this).data("id-selector");
        var classs = $(this).data("class-selector");
        var value = $(this).val();
        var noCommas = value.replace(/,/g, "");
        $('#' + id).val(noCommas);
        $('.' + classs).val(noCommas);
    });
}