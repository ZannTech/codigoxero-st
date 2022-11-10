
$(document).ready(function () {
  $("#man_zon").toggleClass("active");
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
        url: URL + "gestion/crud_zonas/get",
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
          title: "REPORTE DE ZONAS",
          className: "btn btn-outline-danger btn-rounded col-auto mr-4",
          text: "PDF",
          text: '<i class="mdi mdi-file-pdf-box"></i>',
          titleAttr: "Descargar PDF",
          container: "#pdf_btn",
          orientation:'landscape',
          exportOptions: {
            columns: [0, 1, 2, 3, 5],
          },
        },
        {
          extend: "excel",
          title: "REPORTE DE ZONAS",
          text: "Excel",
          className: "btn btn-outline-success btn-rounded col-auto mr-4",
          text: '<i class="mdi mdi-file-excel-outline"></i>',
          titleAttr: "Descargar Excel",
          container: "#excel_btn",
          orientation:'landscape',
          exportOptions: {
            columns: [0, 1, 2, 3, 5],
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
            if(data != null){
              return (
                '<i class="mdi mdi-calendar"></i> ' +
                moment(data).format("DD-MM-Y") +
                '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' +
                moment(data).format("h:mm A") +
                "</span>"
              );
            }else{
              return '-'
            }
          },
        },
        {
          data: null,
          render: function (data, type, row) {
            return `<b>${data.district.description}</b>`;
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
              var e = `<a class="dropdown-item"  href="javascript: flag_update(${data.id_zone})"><i class="mdi mdi-power"></i> Desactivar</a>`;
            } else {
              var e = `<a class="dropdown-item"  href="javascript: flag_update(${data.id_zone})"><i class="mdi mdi-power accion_activar"></i> Activar</a>`;
            }
            return ` <div class="dropdown">
                      <button class="btn btn-rounded btn-ou22 tline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                          <i class="mdi mdi-filter-variant-plus"></i>
                      </button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript: drop_data_id('${data.id_zone}', 'T_ZONES')"><i class="mdi mdi-trash-can"></i> Eliminar</a>
                          <a class="dropdown-item" href="javascript: crud_zona('${data.id_zone}', '${data.description}', '${data.flag_state}', ${data.id_district})"><i class="mdi mdi-progress-pencil"></i> Editar</a>
                          ${e}
                      </div>
                  </div>`;
          },
        },
      ],
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;
        zonas = api
            .rows()
            .data()
            .count();
        $('.zonas-count').text(zonas);
    }
    });
    $("input.global_filter").on("keyup click", function () {
      filterGlobal();
    });

}

function create_zona(){
  $("#modal").modal("show");
}

const flag_update = (id) => {
  $.ajax({
    type: "POST",
    url: URL + "gestion/crud_zonas/flag_update",
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

const crud_zona = (id = "", name = "", state = "", id_district = "") => {
  $("#modal").modal("show");
  if (id == "") {
    $("#id_zona").val("");
    $(".zone_title_modal").html("Agregar Zona");
  } else {
    $("#id_zona").val(id);
    option_select("#zone_state", state);
    option_select("#id_district", id_district);
    $("#zone_name").val(name);
    $(".zone_title_modal").html("Editar Zona");
  }
};

const clean_inputs = () => {
  $("#id_zona").val("");
  option_select("#zone_state", '');
  option_select("#id_district", '');
  $("#zone_name").val('');
  $(".zone_title_modal").html("");
}

$("#modal").on("hidden.bs.modal", function () {
  clean_inputs(); 
})

$(".btn-guardar").on("click", function () {
  let data = {
    zone_id :  $("#id_zona").val(),
    zone_name : $("#zone_name").val(),
    id_district: $("#id_district").selectpicker('val'),
    zone_state: $("#zone_state").selectpicker('val')
  }
  var method = data.zone_id == '' ? 'add' : 'edit'
  if(data.id_district != '' && data.zone_state != '' && data.zone_name != ''){
    $.ajax({
      type: "POST",
      url: URL + 'gestion/crud_zonas/' + method,
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
      url: URL + 'service/excel_import/T_ZONES',
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
