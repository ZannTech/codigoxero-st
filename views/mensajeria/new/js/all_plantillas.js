const conversation = document.querySelector('.conversation');

$(function () {
    lista_datos();
});
const sendAjax = () => {
    ajaxQuery({
        id: $("#id_plantilla").val(),
        name: $("#nombre").val(),
        body: $("#body").val()
    })
}
const crud = (opts = { method: null, id: null }) => {
    $(".modal-title").html(opts.id == null ? 'Agregar Plantilla' : 'Actualizar Plantilla')
    $("#modal_plantilla").modal('show')
}

const ajaxQuery = (data = {
    id: null,
    name: '',
    body: ''
}) => {
    if (data.body != '' && data.name != '') {
        $.ajax({
            type: "POST",
            url: URL + "mensajeria/crud_plantilla",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.error) { 
                    Swal.fire({
                        title: 'Error',
                        html: "Error al registrar la plantilla",
                        icon: 'error'
                    })
                } else {
                    Swal.fire({
                        title: 'Correcto',
                        html: response.msj,
                        icon: 'success'
                    })
                    $("#modal_plantilla").modal('hide')
                    $("#id_plantilla").val(''),
                    $("#nombre").val(''),
                    $("#body").val('')
                    lista_datos();
                }
            }
        });
    } else {
        Swal.fire({
            title: 'Error',
            html: "Rellena todos los campos",
            icon: 'error'
        })
   }
}



function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "mensajeria/get_templates",
            method: "POST",
        },
        destroy: true,
        responsive: true,
        dom: "tip",
        bSort: true,
        order: [[0, "asc"]],
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `<b>${data.nombre}</b>`
                    );
                },
            },{
                data: null,
                render: function (data, type, row) {
                    return (
                        '<i class="mdi mdi-calendar"></i> ' +
                        moment(data.fecha_registro).format("DD-MM-Y")
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `<span class="badge badge-success">Aceptada</span>`
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `
                            <button type="button" class="btn btn-danger" onclick="delete_msj(${data.id})"> <i class="mdi mdi-trash-can"></i> </button>
                            <button type="button" class="btn btn-primary" onclick="show_msj(${data.id})"> <i class="mdi mdi-eye" ></i> </button>
                            `
                    );
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
const delete_msj = (id) => {
    $.ajax({
        type: "POST",
        url: URL + "mensajeria/delete/" + id,
        dataType: "json",
    });
    lista_datos();
    toastr.success("Plantilla eliminada correctamente","Correcto")

}

const show_msj = (id) => {
    let now = new Date()
    let hour = now.getHours()
    let minute = now.getMinutes()
    minute = minute < 10 ? "0"  + minute : minute

    $.ajax({
        type: "POST",
        url: URL + "mensajeria/get_body/" + id,
        dataType: "json",
        success: function (response) {
            $(".conversation").empty();
            $(".conversation").append(`<div class="balloon you">
            ${response.data.body}
            <span class="data blue">${hour} : ${minute}</span>
          </div>`);
            
        }
    });
}

const clock = () => {
    let now = new Date()
    let hour = now.getHours()
    let minute = now.getMinutes()
    let sep = hour >= 12 ? "PM" : "AM"
    let nrm_hour = hour >= 13 ? hour - 12 : hour;
    minute = minute < 10 ? "0"  + minute : minute
    $(".time").empty();
    $(".time").html(`${nrm_hour}: ${minute} ${sep}`);
}
setInterval(() => {
    clock()
}, 1000)
