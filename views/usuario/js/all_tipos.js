$(function () {
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
            url: URL + "usuario/get_tipos",
            method: "POST",
        },
        destroy: true,
        responsive: true,
        dom: "tip",
        bSort: true,
        order: [[0, "asc"]],
        buttons: [
            {
                extend: "pdf",
                title: "REPORTE DE TIPOS DE USUARIOS",
                className: "btn btn-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1],
                },
            },
            {
                extend: "excel",
                title: "REPORTE DE TIPOS DE USUARIOS",
                text: "Excel",
                className: "btn btn-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1],
                },
            },
        ],
        columns: [
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
                    if(!data.tx.c){
                        return '0'
                    }else{
                        return `<b>${data.tx.c}</b>`
                    }
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
            }
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(),
                data;
            usuarios = api.rows().data().count();
            $(".usuarios-count").text(usuarios);
        },
    });
    $("input.global_filter").on("keyup click", function () {
        filterGlobal();
    });
}