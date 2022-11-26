$(function () {
    lista_datos();
});
function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "mensajeria/get_files",
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
                title: "REPORTE DE DISTRITOS",
                className: "btn btn-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2],
                },
            },
            {
                extend: "excel",
                title: "REPORTE DE DISTRITOS",
                text: "Excel",
                className: "btn btn-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2],
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
                data: "local_route",
                render: function (data, type, row) {
                    let name = data.replace('public/files/uploads/', '');
                    return `<b>${name}</b>`;
                },
            },
            {
                data: "file_type",
                render: function (data, type, row) {
                    return `<b>${data}</b>`;
                },
            },
            {
                data: "server_route",
                render: function (data, type, row) {
                    return `<b>${data}</b>`;
                },
            },
            {
                data: "server_route",
                render: function (data, type, row) {
                    return `<a class="btn btn-info p-3" target="_blank" href="${data}"><i class="mdi mdi-eye-outline"></i></a>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button class="btn btn-danger p-3" onclick="delete_file(${data.id_file})"><i class="mdi mdi-trash-can-outline"></i></button>`;
                },
            },
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(),
                data;
            distritos = api.rows().data().count();
            $(".distritos-count").text(distritos);
        },
    });
    $("input.global_filter").on("keyup click", function () {
        filterGlobal();
    });
}

Dropzone.autoDiscover = false;
let myDropzone = new Dropzone("form.dropzone", {
    dictDefaultMessage: 'Selecciona el archivo para subir Menor 5 MB. <br/>Lista de archivos soportados: JPEG, PNG, JPG, PDF y Audios',
    url: URL + "service/upload_file_msj",
    paramName: 'file',
    addRemoveLinks: true,
    dictRemoveFileConfirmation: 'Estás seguro de quitar el archivo de la lista?',
    maxFiles: 1,
    acceptedFiles: "",
    maxFilesize: 100,
    complete: (e) => {
        let json = JSON.parse(e.xhr.response)
        if (json.status == 'ok') {
            toastr.success("Archivo subido correctamente", "Notificación");
            $("#modal_files").modal("hide")
            lista_datos()

        } else {
            toastr.error(json.msj, "Notificación");
        }
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if ($("#file_temp").val() != "") {
            $.ajax({
                type: "POST",
                url: URL + 'service/delete_file_msj',
                data: {
                    id_temp: $("#file_temp").val()
                },
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        $("#file_temp").val('')
                        toastr.success("Archivo eliminado correctamente", "Notificación");
                    } else {
                        toastr.error("Error al eliminar el archivo", "Notificación");
                    }
                }
            });
        }
    }
});

$(".upload_btn").on("click", function (e) {
    $("#modal_files").modal("show")
})
$("#modal_files").on("hidden.bs.modal", function (e) {
    var xDrop = Dropzone.forElement("form.dropzone");
    xDrop.removeAllFiles(false);
    $("#file_temp").val('')
})
const delete_file = (id) =>{
    $.ajax({
        type: "POST",
        url: URL + 'service/delete_file_msj',
        data: {
            id_temp : id
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                toastr.success("Archivo eliminado correctamente", "Notificación");
                lista_datos();
            } else {
                toastr.error("Error al eliminar el archivo", "Notificación");
            }
        }
    });
}
