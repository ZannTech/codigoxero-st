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
            url: URL + "usuario/get_persons",
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
                title: "REPORTE DE PERSONAS",
                className: "btn btn-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                },
            },
            {
                extend: "excel",
                title: "REPORTE DE PERSONAS",
                text: "Excel",
                className: "btn btn-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                },
            },
        ],
        columns: [
            {
                data: "date_create",
                render: function (data, type, row) {
                    return (
                        '<i class="mdi mdi-calendar"></i> ' +
                        moment(data).format("DD-MM-Y") +
                        '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' +
                        moment(data).format("h:mm A") +
                        "</span>"
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<span class="badge badge-success">${data.type_user.type}</span>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.nombre}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.dni}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.distrito.description}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.zona.description}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.manzana.description}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.longitude + ',' +  data.latitude}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.email}</b>`;
                },
            },
            
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