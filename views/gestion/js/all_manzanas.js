
$(document).ready(function () {
  $("#mant_man").toggleClass("active");
});
$(function () {
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
    dom: "Bfrtip",
    ajax: {
      url: URL + "gestion/crud_manzanas/get",
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
        title: "REPORTE DE MANZANAS",
        className: "btn btn-danger btn-rounded col-auto mr-4",
        text: "PDF",
        text: '<i class="mdi mdi-file-pdf-box"></i>',
        titleAttr: "Descargar PDF",
        container: "#pdf_btn",
        orientation: 'landscape',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 5, 6],
        },
      },
      {
        extend: "excel",
        title: "REPORTE DE MANZANAS",
        text: "Excel",
        className: "btn btn-success btn-rounded col-auto mr-4",
        text: '<i class="mdi mdi-file-excel-outline"></i>',
        titleAttr: "Descargar Excel",
        container: "#excel_btn",
        orientation: 'landscape',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 5, 6],
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
        data: "date_update",
        render: function (data, type, row) {
          if (data != null) {
            return (
              '<i class="mdi mdi-calendar"></i> ' +
              moment(data).format("DD-MM-Y") +
              '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' +
              moment(data).format("h:mm A") +
              "</span>"
            );
          } else {
            return '-'
          }
        },
      },
      {
        data: "description",
        render: function (data, type, row) {
          return `<b>${data}</b>`;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `<b>${data.zone.description}</b>`;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `<b>${data.district.description}</b>`;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if(data.coord){
            return `<b>${data.coord.nombre}</b>`;
          }else{
            return 'S/N'
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
      },
      {
        data: null,
        render: function (data, type, row) {
          if (data.flag_state == "01") {
            var e = `<a class="dropdown-item"href="javascript: flag_update(${data.id_street})"><i class="mdi mdi-power"></i> Desactivar</a>`;
          } else {
            var e = `<a class="dropdown-item" href="javascript: flag_update(${data.id_street})"><i class="mdi mdi-power"></i> Activar</a>`;
          }
          return ` <div class="dropdown">
                      <button class="btn btn-rounded btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                          <i class="mdi mdi-filter-variant-plus"></i>
                      </button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript: drop_data_id('${data.id_street}', 'T_STREETS')"><i class="mdi mdi-trash-can"></i> Eliminar</a>
                          <a class="dropdown-item" href="javascript:crud_manzana(${data.id_street}, '${data.description}', '${data.flag_state}', ${data.id_zone}, ${data.district.id_district})"><i class="mdi mdi-progress-pencil"></i> Editar</a>
                          ${e}
                      </div>
                    </div>`;
          },
      },
    ],
    "footerCallback": function (row, data, start, end, display) {
      var api = this.api(), data;
      manzanas = api
        .rows()
        .data()
        .count();
      $('.manzanas-count').text(manzanas);
    }
  });
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
}

const flag_update = (id) => {
  $.ajax({
    type: "POST",
    url: URL + "gestion/crud_manzanas/flag_update",
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



const crud_manzana = (id = "", name = "", state = "", id_zone = "", id_district = "") => {
  $("#modal").modal("show");
  if (id == "") {
    $("#street_id").val("");
    $(".title_street").html("Agregar Manzana");
  } else {
    $("#street_id").val(id);
    option_select("#street_state", state);
    option_select("#id_district", id_district);
    let value = $("#id_district").selectpicker('val')
    filter_zones(value, id_zone)

    $("#street_name").val(name);
    $(".title_street").html("Editar Manzana");
  }
};

const clean_inputs = () => {
  $("#street_id").val("");
  option_select("#street_state", '');
  option_select("#id_district", '');
  option_select("#id_zone", '');
  $("#street_name").val('');
  $(".title_street").html("");
  $("#file_temp").val()

}

$("#modalm #modal_excel").on("hidden.bs.modal", function () {
  clean_inputs();
})

$("#id_district").on("change", function (e) {
  let value = $("#id_district").selectpicker('val')
  filter_zones(value)
})
const filter_zones = (id_district = '', id_zone = '') => {
  if(id_district != ""){
    $.ajax({
      type: "POST",
      url: URL + 'gestion/get_by_id',
      data: {
        get_info : 'T_ZONES',
        id: id_district
      },
      dataType: "json",
      success: function (response) {
          $("#id_zone").empty()
          if(response.data.length > 0){
            $("#id_zone").append(`<option value="">Selecciona una opcion</option>`)
            $("#id_zone").attr("disabled", false);
            for(let x of response.data){
              $("#id_zone").append(`<option value="${x.id_zone}">${x.description}</option>`)
            }
          }else{
            $("#id_zone").attr("disabled", true);
          }
          $("#id_zone").selectpicker('refresh')
          option_select("#id_zone", id_zone);

      }
    });
  }else{
    $("#id_zone").attr("disabled", true);
  }
}
$(".btn-guardar").on("click", ()=>{
  let data = {
    zone_id : $("#id_zone").selectpicker('val'),
    street_name : $("#street_name").val(),
    street_state: $("#street_state").selectpicker('val'),
    street_id : $("#street_id").val()
  }
  let method = data.street_id == '' ? 'add' : 'edit'
  if(data.street_name != '' && data.zone_id != '' && data.street_state != ''){
    $.ajax({
      type: "POST",
      url: URL + 'gestion/crud_manzanas/' + method,
      data: data,
      dataType: "json",
      success: function (response) {
        if(response.status == 'ok'){
          toastr.success(response.msj, 'Notificación')
          $("#modal").modal("hide");
          lista_datos();
          clean_inputs();
        }else{
          if(response.error){
            toastr.error(response.msj, 'Error')
          }
        }
      }
    });
  }else{
    toastr.error('Favor de rellenar todos los campos', 'Error')
  }
}) 

$(".excel_btn").on("click", () => {
  $("#modal_excel").modal('show')
})


$(".import").on("click", () => {
  if ($("#file_temp").val() != "") {
    $.ajax({
      type: "POST",
      url: URL + 'service/excel_import/T_STREETS',
      data: {
        id_tmp: $("#file_temp").val()
      },
      dataType: 'json',
      success: function (response) {
        console.log(response)
        if (response.status) {
          if (response.status == 'ok') {
            $("#modal_excel").modal('hide')
            toastr.success(response.msj, 'Notificación');
            lista_datos();
            var xDrop = Dropzone.forElement("form.dropzone");
            xDrop.removeAllFiles(true);
          }
        } else {
          toastr.error(response.msj, 'Notificación');
          var xDrop = Dropzone.forElement("form.dropzone");
          xDrop.removeAllFiles(true);
        }
      }
    });
  } else {
    toastr.error("Debes subir un archivo formato xlsx o csv", "Notificación");
  }
})
