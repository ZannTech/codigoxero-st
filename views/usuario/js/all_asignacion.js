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
})

$("#type").on("change", (e) => {
    let val = $("#type").selectpicker('val')
    if (val != '') {
        $("#id_asignado").empty()
        $("#id_asignado").prop('disabled', false)
        $("#id_asignado").append(`
        <option value="" selected>Selecciona una opción</option>
        `)
        $.ajax({
            type: "POST",
            url: URL + 'usuario/get_data_asgn/' + val,
            dataType: "json",
            success: function (response) {
                for (let x of response.data) {
                    $("#id_asignado").append(`
                        <option value="${x.uid}">${x.description}</option>
                    `)
                }
                $("#id_asignado").selectpicker('refresh')
            }
        });
    } else {
        $("#id_asignado").empty()
        $("#id_asignado").prop('disabled', true)
        $("#id_asignado").selectpicker('refresh')
    }
})

$("#assign").on("click", () => {
    let data = {
        id_asignado: $("#id_asignado").selectpicker('val'),
        tipo: $("#type").selectpicker('val'),
        uid_coordinador: $("#uid_coordinador").selectpicker('val'),
    }
    if (data.id_asignado != '' && data.tipo != '' && data.uid_coordinador != '') {
        $.ajax({
            type: "POST",
            url: URL + 'usuario/asignHandler/assign',
            data: data,
            dataType: "json",
            beforeSend: () => {
                $("#assign").prop("disabled", true)
            },
            success: function (response) {
                if (response.status == 'ok') {
                    toastr.success(response.msj, 'Notificación', {
                        closeDuration: 300,
                        onHidden: () => {
                            window.location.reload()
                        }
                    })

                } else {
                    toastr.error(response.msj, 'Error')
                }
            }
        });
    } else {
        toastr.error("Favor de rellenar todos los campos")
    }
})

function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "usuario/get_asignaciones",
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
                title: "REPORTE ASIGNACIONES",
                className: "btn btn-outline-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: "excel",
                title: "REPORTE ASIGNACIONES",
                text: "Excel",
                className: "btn btn-outline-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
        ],
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        '<i class="mdi mdi-calendar"></i> ' +
                        moment(data.fecha_asignado).format("DD-MM-Y")
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return data.fecha_fin == null ? '-' : '<i class="mdi mdi-calendar"></i> ' +
                        moment(data.fecha_fin).format("DD-MM-Y")
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (data.type).toLowerCase();
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.detalle.description}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.coordinador.first_name + ' ' + data.coordinador.last_name}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return data.meta != null ? data.meta.cant_proposal : '-';
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let s = data.meta != null ? data.meta.cant_proposal - data.personas.c : null
                    let p = s < 0 ? '0' : s
                    return data.meta != null ? `<b>${(p)} PERSONAS</b>` : '-'
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.meta != null) {
                        let pct = (100 * data.personas.c) / data.meta.cant_proposal;
                        pct = pct >= 100 ? 100.00 : pct;
                        let class_name = '';
                        switch (true) {
                            case pct < 20:
                                class_name = 'bg-danger'
                                break;
                            case pct > 20 && pct < 70:
                                class_name = 'bg-warning'
                                break;
                            case pct > 70 && pct < 99:
                                class_name = 'bg-primary'
                                break;
                            case pct == 100:
                                class_name = 'bg-success'
                                break;
                        }
                        return `
                        <div class="progress_area">
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar ${class_name} progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:${pct.toFixed(2)}%">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <span class="badge badge-success">${(pct.toFixed(2))}%</span>
                        </div>
                        `;
                    } else {
                        return '-';
                    }

                },
            },
            {
                data: null,
                render: function (data, type, row) {

                        return data.fecha_fin != null ?  `-` : `
                        <div class="col-lg-12">
                        <button class="btn btn-outline-danger col-12 mt-1" onclick="delele_assign(${data.id_asignacion})" title="Borrar"><i class="mdi mdi-delete"></i></button>
                        <button class="btn btn-outline-warning col-12 mt-1" onclick="finish_assign(${data.id_asignacion})" title="Terminar Asignación"><i class="mdi mdi-flag-off"></i></button>
                    </div>
                        `
                    
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

const finish_assign = (uid)=>{
    $.ajax({
        type: "POST",
        url: URL + 'usuario/finish_assign/' + uid,
        dataType: "json",
        success: function (response) {
            lista_datos();
            if (response.status == 'ok') {
                toastr.success(response.msj, 'Notificación', {
                    closeDuration: 300,
                })
            } else {
                toastr.error(response.msj, 'Error')
            }

        }
    });
}
const delele_assign = (uid) =>{
    $.ajax({
        type: "POST",
        url: URL + 'usuario/delete_assign/' + uid,
        dataType: "json",
        success: function (response) {
            lista_datos();
            if (response.status == 'ok') {
                toastr.success(response.msj, 'Notificación', {
                    closeDuration: 300,
                })
            } else {
                toastr.error(response.msj, 'Error')
            }

        }
    });
}