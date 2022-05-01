function load_content_input(url) {
    // show_progress('input');
    $.post(url, {}, function(result) {
        $('#content_input').html(result);
        main_content('content_input');
        // hide_progress();
    }, "html");
}
function open_modal(id)
{
    $(id).modal('show');
}
function save_form(tombol,form,url,callback)
{
    $(tombol).submit(function () {
        return false;
    });
    let data = $(form).serialize();
    $(tombol).prop("disabled", true);
    $(tombol).html("Harap tunggu");
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.alert=="success") {
                success_message(response.message);
                $(form)[0].reset();
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html("Kirim");
                    location.reload();
                }, 2000);
            } else {
                error_message(response.message);
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html("Kirim");
                }, 2000);
            }
        },
    });
    
}
function save_form_modal(tombol,form,url,modal)
{
    $(tombol).submit(function () {
        return false;
    });
    let data = $(form).serialize();
    $(tombol).prop("disabled", true);
    $(tombol).html("Harap tunggu");
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.alert=="success") {
                success_message(response.message);
                $(form)[0].reset();
                $(modal).modal('toggle');
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html("Daftarkan");
                    load_list(1);
                }, 2000);
            } else {
                error_message(response.message);
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html("Daftarkan");
                }, 2000);
            }
        },
    });
    
}
function upload_form_modal(tombol,form,url,modal)
{
    $(document).one('submit', form, function (e) {
        let data = new FormData(this);
        data.append('_method', 'POST');
        $(tombol).prop("disabled", true);
        $(tombol).html("Harap tunggu");
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            resetForm: true,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.alert=="success") {
                    success_message(response.message);
                    $(form)[0].reset();
                    $(modal).modal('hide');
                    setTimeout(function () {
                        $(tombol).prop("disabled", false);
                        $(tombol).html("Daftarkan");
                        load_list(1);
                    }, 2000);
                } else {
                    error_message(response.message);
                    setTimeout(function () {
                        $(tombol).prop("disabled", false);
                        $(tombol).html("Daftarkan");
                    }, 2000);
                }
            },
        });
        return false;
    });

}
function handle_open_modal(id,url,modal,content){
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id
        },
        success: function (html) {
            $(content).html(html);
            $(modal).modal('show');
        },
        error: function () {
            $(content).html('<h3>Ajax Bermasalah !!!</h3>')
        },
    });
}
function handle_delete(id,url)
{
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, tentu",
        cancelButtonText: "Tidak",
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {
                    if (response.alert=="success") {
                        Swal.fire(
                            "Penghapusan sukses!",
                            response.message,
                            "success"
                        );
                        load_list(1);
                    }
                },
            });
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "Dibatalkan",
                "Penghapusan data dibatalkan",
                "error"
            )
        }
    });
}