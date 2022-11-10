let map_rendered = false;
/// <reference path="../../../public/assets/js/inputmask.js" />

$(document).ready(function () {
    $("#dni").mask('00000000');
    $("#short_phone").mask('00000000000')
    $("#meta").mask("0000000000");
    lista_datos();
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
});

function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "usuario/get_users",
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
                title: "REPORTE DE USUARIOS",
                className: "btn btn-outline-danger btn-rounded col-auto mr-4",
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
                title: "REPORTE DE USUARIOS",
                text: "Excel",
                className: "btn btn-outline-success btn-rounded col-auto mr-4",
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
                    return `<b>${data.first_name + ' ' + data.last_name}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.type_user.type}</b>`;
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
                    return ` <div class="dropdown">
                      <button class="btn btn-rounded btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                          <i class="mdi mdi-filter-variant-plus"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript: crud_usuarios(${data.dni})"><i class="mdi mdi-progress-pencil"></i> Editar</a>
                          <a class="dropdown-item" href="javascript: crud_usuarios(${data.dni}, true)"><i class="mdi mdi-eye-outline"></i> Detalle</a>
                          <a class="dropdown-item" href="javascript: deleteUser(${data.dni})"><i class="mdi mdi-trash-can"></i> Eliminar</a>

                      </div>
                  </div>`;
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
const limpia_datos = () => {
    option_select("#id_type", '')
    $("#dni").val('')
    $("#password").val('')
    $("#first_name").val('')
    $("#last_name").val('')
    $("#date_of_birth").val('')
    option_select("#id_district", '')
    option_select("#id_zone", '')
    option_select("#id_street", '')
    filter('zone', '', '', '')
    filter('street', '', '', '')
    option_select("#id_genre", '')
    $("#address").val('')
    $("#social_whatsapp").prop('checked', false)
    $("#social_facebook").val('')
    $("#social_twitter").val('')
    $("#social_instagram").val('')
    $("#social_tiktok").val('')
    $("#social_twitch").val('')
    $("#email").val('')
    option_select("#lada_phone", '+51')
    $("#short_phone").val('')
    $("#user_id").val('')
    $("#meta").val('')
}
const change_state_inputs = (disable = true) => {
    $("#dni").attr("disabled", disable)
    $("#password").attr("disabled", disable)
    $("#first_name").attr("disabled", disable)
    $("#last_name").attr("disabled", disable)
    $("#date_of_birth").attr("disabled", disable)
    $("#address").attr("disabled", disable)
    $("#social_whatsapp").attr("disabled", disable)
    $("#social_facebook").attr("disabled", disable)
    $("#social_twitter").attr("disabled", disable)
    $("#social_instagram").attr("disabled", disable)
    $("#social_tiktok").attr("disabled", disable)
    $("#social_twitch").attr("disabled", disable)
    $("#email").attr("disabled", disable)
    $("#short_phone").attr("disabled", disable)
    $("#meta").attr("disabled", disable)

    select_change("#id_type", disable)
    select_change("#id_zone", disable)
    select_change("#id_genre", disable)
    select_change("#id_street", disable)
    select_change("#lada_phone", disable)
    select_change("#id_district", disable)
    select_change("#id_genre", disable)
}
function select_change(target, value) {
    $(target).prop('disabled', value);
    $(target).selectpicker('refresh');
}
function get_usu_data(dni, disabled = false) {
    $.ajax({
        type: "POST",
        url: URL + 'usuario/get_data_user/' + dni,
        data: {
            dni: dni
        },
        dataType: "json",
        success: function (response) {
            let usu = response.data;
            option_select("#id_type", usu.user.id_typeuser)
            $("#dni").val(usu.dni)
            $("#first_name").val(usu.first_name)
            $("#last_name").val(usu.last_name)
            $("#meta").val(usu.meta.cant_proporsal)
            $("#password").val(usu.user.password)
            $("#date_of_birth").val(usu.date_birth)
            option_select("#id_district", usu.id_district)
            filter('zone', usu.id_district, usu.id_zone, '')
            filter('street', usu.id_zone, '', usu.id_street)
            option_select("#id_genre", usu.id_sexo)
            $("#address").val(usu.direction)
            if (usu.phone != null && usu.phone != '') {
                let tel = usu.phone
                let index = tel.indexOf(' ', 0)
                let lada = tel.substring(0, index)
                let number = tel.substring(index + 1, tel.length)
                option_select("#lada_phone", lada)
                $("#short_phone").val(number)
            }
            if (usu.whatsApp != '') {
                $("#social_whatsapp").prop('checked', true)
            }
            $("#social_facebook").val(usu.link_facebook)
            $("#social_twitter").val(usu.link_twitter)
            $("#social_instagram").val(usu.link_instagram)
            $("#social_tiktok").val(usu.link_tiktok)
            $("#social_twitch").val(usu.link_twitch)
            $("#email").val(usu.email)
            change_state_inputs(disabled)
        }
    });
}

const crud_usuarios = (id_usu = '', view = false) => {
    // in this case, lets request to the server the data
    $("#user_id").val(id_usu)
    if (id_usu != "") {
        $(".metas").css("display", "none")
        if (view == true) {
            $(".help_map").hide();
            $(".map").hide();
            $(".modal-footer").hide()
            //vista
            $(".title_modal").html("Vizualización de datos")
            get_usu_data(id_usu, true);
        } else {
            get_usu_data(id_usu, false);
            $(".help_map").hide();
            $(".map").hide();
            $(".modal-footer").show()
            $("#dni").attr('disabled', true);
            $(".title_modal").html("Actualización de datos")
        }
    } else {
        $(".metas").css("display", "block")
        $(".map").show();
        $(".help_map").show();
        $("#dni").attr('disabled', false);
        if (map_rendered == false) {
            view_map();
            map_rendered = true
        }
        $(".title_modal").html("Registro de coordinador / simpatizante")
    }
    $("#modal").modal('show')
}
$(".btn-guardar").on("click", function () {
    let data = {
        type_user: $("#id_type").selectpicker('val'),
        dni: $("#dni").val(),
        password: $("#password").val(),
        first_name: $("#first_name").val(),
        last_name: $("#last_name").val(),
        date_of_birth: $("#date_of_birth").val(),
        id_district: $("#id_district").selectpicker('val'),
        id_zone: $("#id_zone").selectpicker('val'),
        id_street: $("#id_street").selectpicker('val'),
        id_genre: $("#id_genre").selectpicker('val'),
        address: $("#address").val(),
        id_asignado : $("#id_asignado").selectpicker('val'),
        meta: $("#meta").val(),
        type_assign: $("#type").selectpicker('val'),
        lada: $("#lada_phone").selectpicker('val'),
        telephone: $("#lada_phone").selectpicker('val') + ' ' + $("#short_phone").val(),
        social: {
            whatsapp: $("#social_whatsapp").prop('checked') ? "1" : '0',
            facebook: $("#social_facebook").val(),
            twitter: $("#social_twitter").val(),
            instagram: $("#social_instagram").val(),
            tiktok: $("#social_tiktok").val(),
            twitch: $("#social_twitch").val()
        },
        email: $("#email").val(),
        location: {
            long: $("#longitud").val(),
            lat: $("#latitud").val(),
        },
        user_id: $("#user_id").val(),
    }
    let method = data.user_id != "" ? "edit" : "add"
    if (data.dni != "" && data.type_user != "" && data.password != "" &&
        data.first_name != "" && data.last_name != "" && data.date_of_birth != "" && data.id_district != ""
        && data.id_zone != "" && data.id_street != "" && data.id_genre != "" && data.address != "" && data.telephone != ""
        && data.email != "" && data.lada != ""
    ) {
        if ((data.location.lat != "" && data.location.long) || method == "edit") {
         
            $.ajax({
                type: "POST",
                url: URL + 'usuario/crud_usuario/' + method,
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        if (method == 'add') {
                            $.ajax({
                                type: "POST",
                                url: URL + "service/send_bienvenida ",
                                data: {
                                    tlf: data.telephone,
                                    tipo: data.type_user,
                                    nombre: data.first_name + ' ' + data.last_name
                                },
                                dataType: "json",
                            });
                        }
                        $("#modal").modal("hide")
                        lista_datos();
                        toastr.success(response.msj, 'Notificación')

                    } else {
                        toastr.error(response.msj, 'Error')
                    }
                }
            });
           
        } else {
            toastr.error("Favor de permitir a la l página acceder a tu ubicación, y recarga la página", "Error de Ubicación")
        }
    } else {
        toastr.error("Favor de rellenar todos los campos requeridos (*)", "Error")
    }
})


$("#id_district").on("change", function () {
    filter('zone', $("#id_district").selectpicker('val'))
})

$("#id_zone").on("change", function () {
    filter('street', $("#id_zone").selectpicker('val'))
})
const filter = (data, value, id_zone_fill = '', id_street_fill = '') => {
    if (data == 'zone') {
        if (value == '') {
            $("#id_zone").empty();
            $("#id_zone").attr('disabled', true)
            $("#id_zone").selectpicker('refresh')
            option_select("#id_street", '');
        } else {
            $.ajax({
                type: "POST",
                url: URL + 'service/get_zones_by_district/' + value,
                dataType: "json",
                success: function (response) {
                    $("#id_zone").empty();
                    $("#id_zone").append(`<option value="">Selecciona una opcion</option>`)
                    if (response.data.length > 0) {
                        $("#id_zone").attr("disabled", false);
                        for (let x of response.data) {
                            $("#id_zone").append(`<option value="${x.id_zone}">${x.description}</option>`)
                        }
                    } else {
                        $("#id_zone").empty();
                        $("#id_street").empty();
                        $("#id_zone").attr('disabled', true)
                        $("#id_street").attr('disabled', true)
                        $("#id_zone").selectpicker('refresh')
                    }
                    $("#id_zone").selectpicker('refresh')
                    option_select("#id_zone", id_zone_fill);
                }
            });
        }
    } else {
        if (value == '') {
            $("#id_street").empty();
            $("#id_street").attr('disabled', true)
            $("#id_street").selectpicker('refresh')
            option_select("#id_street", '');
        } else {
            $.ajax({
                type: "POST",
                url: URL + 'service/get_streets_by_zone/' + value,
                dataType: "json",
                success: function (response) {
                    $("#id_street").empty();
                    $("#id_street").append(`<option value="">Selecciona una opcion</option>`)
                    $("#id_street").attr('disabled', false)
                    if (response.data.length > 0) {
                        for (let x of response.data) {
                            $("#id_street").append(`<option value="${x.id_street}">${x.description}</option>`)
                        }
                    } else {
                        $("#id_street").attr('disabled', true)
                    }
                    $("#id_street").selectpicker('refresh')
                    option_select("#id_street", id_street_fill);
                }
            });
        }
    }
}

$("#modal").on("hidden.bs.modal", function (e) {
    limpia_datos();
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
$("#id_type").on("change", (e)=>{
    let val = $("#id_type").selectpicker('val')
    if(val == '4'){
        $(".metas").css("display", "block")
    }else{
        $(".metas").css("display", "none")
    }
})

const deleteUser = function (dni) {
    $.ajax({
        type: "POST",
        url: URL +  "usuario/delete_user/" + dni,
        success: function () {
            Swal.fire({
                icon:'success',
                title:'Eliminado',
                html: 'Eliminado correctamente.'
            }).then(()=>{
                lista_datos()
            })
        }
    });
}