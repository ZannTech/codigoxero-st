
$(document).ready(function () {
  $("#man_dist").toggleClass("active");
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
  limpia_campos();
  function filterGlobal() {
    $("#table").DataTable().search($(".global_filter").val()).draw();
  }
  var table = $("#table").DataTable({
    ajax: {
      url: URL + "gestion/crud_distritos/get",
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
        data: "date_update",
        render: function (data, type, row) {
          let xhtml = '';
          if(data != '' && data != null){
            xhtml = '<i class="mdi mdi-calendar"></i> ' +
            moment(data).format("DD-MM-Y") +
            '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' +
            moment(data).format("h:mm A") +
            "</span>"
          }else{
            xhtml = '-';
          }
          return xhtml;
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
            var e = `<a class="dropdown-item" href="javascript: flag_update(${data.id_district})"><i class="mdi mdi-power"></i> Desactivar</a>`;
          } else {
            var e = `<a class="dropdown-item" href="javascript: flag_update(${data.id_district})"><i class="mdi mdi-power"></i> Activar</a>`;
          }
          return ` <div class="dropdown">
                    <button class="btn btn-rounded btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="mdi mdi-filter-variant-plus"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript: drop_data_id('${data.id_district}', 'T_DISTRICTS')"><i class="mdi mdi-trash-can"></i> Eliminar</a>
                        <a class="dropdown-item" href="javascript: crud_district(${data.id_district}, '${data.description}', '${data.flag_state}')"><i class="mdi mdi-progress-pencil"></i> Editar</a>
                        ${e}
                    </div>
                </div>`;
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
const crud_district = (id = "", name = "", state = "") => {
  $("#modal").modal("show");
  if (id == "") {
    $("#id_distrito").val("");
    $(".title_district").html("Agregar Distrito");
  } else {
    $("#id_distrito").val(id);
    option_select("#district_state", state);
    $("#district_name").val(name);
    $(".title_district").html("Editar Distrito");
  }
};
$(".excel_btn").on("click", () => {
  $("#modal_excel").modal('show')
})
$("#modal, #modal_excel").on("hidden.bs.modal", function () {
  limpia_campos();
});
const limpia_campos = () => {
  $("#id_distrito").val("");
  $("#district_name").val("");
  option_select("#district_state", "");
  $("#file_temp").val()
};

$("#form").on("submit", (e) => {
  e.preventDefault();
  let data = {
    id_district: $("#id_distrito").val() != "" ? $("#id_distrito").val() : "",
    district_name: $("#district_name").val(),
    district_state: $("#district_state").selectpicker("val"),
  };

  if (
    data.district_state != "" &&
    data.district_name != ""
  ) {
    let method = $("#id_distrito").val() != "" ? "edit" : "add";
    $.ajax({
      type: "POST",
      url: URL + "gestion/crud_distritos/" + method,
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
      },
    });
  } else {
    Toast.fire({
      title: "Error",
      html: "Completa todos los campos",
      icon: "error",
    });
  }
});

const flag_update = (id) => {
  $.ajax({
    type: "POST",
    url: URL + "gestion/crud_distritos/flag_update",
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

$(".import").on("click", () => {
  if ($("#file_temp").val() != "") {
    $.ajax({
      type: "POST",
      url: URL + 'service/excel_import/T_DISTRICTS',
      data: {
        id_tmp: $("#file_temp").val()
      },
      dataType: 'json',
      success: function (response) {
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

