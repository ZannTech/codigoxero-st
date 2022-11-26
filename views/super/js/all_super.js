$(function () {
    'use strict';
    var org_buildButton = $.fn.DataTable.Buttons.prototype._buildButton;
    $.fn.DataTable.Buttons.prototype._buildButton = function (
        config,
        collectionButton
    ) {
        var button = org_buildButton.apply(this, arguments);
        $(document).one("init.dt", function (e, settings, json) {
            if (config.container && $(config.container).length) {
                $(button.inserter[0]).detach().appendTo(config.container);
            }
        });
        return button;
    };
    lista_datos();
});
function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "super/get_users",
            method: "POST",
        },
        destroy: true,
        responsive: true,
        dom: "tip",
        bSort: true,
        order: [[0, "desc"]],
        buttons: [
            {
                extend: "pdf",
                title: "REPORTE DE SUPER USUARIOS",
                className: "btn btn-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: "excel",
                title: "REPORTE DE SUPER USUARIOS",
                text: "Excel",
                className: "btn btn-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
        ],
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        '<i class="mdi mdi-calendar"></i> ' +
                        moment(data.date_create).format("DD-MM-Y")
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let op = data.date_update != null ? data.date_update : '-'
                    if (op == '-') {
                        return '<b>' + op + '</b>'
                    } else {
                        return ('<i class="mdi mdi-calendar"></i> ' +
                            moment(op).format("DD-MM-Y"));
                    }

                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `<b>${data.description}</b>`
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `<b>${data.user}</b>`
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.flag_state == "01") {
                        return '<span class="badge badge-success">Activo</span>';
                    } else {
                        return '<span class="badge badge-danger">Desactivado</span>';
                    }
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.flag_state == "01") {
                        var e = `<a class="dropdown-item" href="javascript: flag_update(${data.id_customer})"><i class="mdi mdi-power"></i> Desactivar</a>`;
                    } else {
                        var e = `<a class="dropdown-item" href="javascript: flag_update(${data.id_customer})"><i class="mdi mdi-power"></i> Activar</a>`;
                    }
                    return ` <div class="dropdown">
                            <button class="btn btn-rounded btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="mdi mdi-filter-variant-plus"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript: crud_super('${data.id_customer}', '${data.description}', '${data.user}', '${data.flag_state}')"><i class="mdi mdi-progress-pencil"></i> Editar</a>
                                ${e}
                            </div>
                        </div>`;
                },
            }
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(),
                data;
            usuarios = api.rows().data().count();
            $(".metas-count").text(usuarios);
        },
    });
    $("input.global_filter").on("keyup click", function () {
        filterGlobal();
    });
}


const flag_update = (id) => {
    $.ajax({
        type: "POST",
        url: URL + "super/crud_super/flag_update",
        data: {
            id: id,
        },
        dataType: "json",
        success: function (response) {
            if (response.status) {
                lista_datos();
                toastr.success(response.msj, "Notificación");
            } else {
                lista_datos();
                toastr.error("Error", response.msj);
            }
        },
    });
};
const crud_super = (id = '', desc = '', usuario = '', estado = '') => {
    $("#modal").modal("show")
    $("#pwd").val('')
    if(id != ''){
        $("#desc").val(desc);
        $("#usuario").val(usuario)
        $("#id_super").val(id)
        option_select("#user_state", estado);
    }else{
        limpia_campos();
    }
   
    id == ''  ? $(".title_modal").text("Agregar Super Usuario") : $(".title_modal").text("Editar Super Usuario")
}
$("#modal").on("show.bs.modal", function (e) {
    limpia_campos();
})
const limpia_campos = ()=>{
    $("#desc").val('');
    $("#usuario").val('')
    option_select("#user_state", '');
    $("#id_super").val('')
    $("#pwd").val('')
}
$(".btn-guardar").on("click", () => {
    let data = {
        desc: $("#desc").val(),
        user: $("#usuario").val(),
        pwd: $("#pwd").val(),
        user_state: $("#user_state").selectpicker('val'),
        id_user: $("#id_super").val(),
    }
    console.log(data)
    if (data.desc != '' && data.usuario != '' && data.pwd != '' && data.user_state != '') {
        $.ajax({
            type: "POST",
            url: URL + "super/crud_super/crud",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    $("#modal").modal("hide");
                    lista_datos();
                    toastr.success(response.msj, "Notificación");
                } else {
                    toastr.error(response.msj, "Notificación");
                }
            }
        });
    }else{
        toastr.error('Rellena todos los datos', "Notificación");
    }
})