Dropzone.autoDiscover = false;
let myDropzone = new Dropzone("form.dropzone", {
  dictDefaultMessage: "Selecciona el archivo de imagen para subir.",
  url: URL + "service/upload_logo",
  paramName: "file",
  addRemoveLinks: true,
  dictRemoveFileConfirmation: "Estás seguro de quitar el archivo de la lista?",
  maxFiles: 1,
  acceptedFiles: "image/png, image/jpeg, image/jpg",
  maxFilesize: 2,
  complete: (e) => {
    let json = JSON.parse(e.xhr.response);
    if (json.status == "ok") {
      toastr.success("Archivo subido correctamente", "Notificación");
      toastr.info(
        "Para terminar la importación, da click en `Importar` ",
        "Notificación"
      );
      $("#file_temp").val(json.msj);
      $(".import").attr("disabled", false);
    } else {
      toastr.error(json.msj, "Notificación");
    }
  },
  removedfile: function (file) {
    file.previewElement.remove();
    if ($("#file_temp").val() != "") {
      $.ajax({
        type: "POST",
        url: URL + "service/delete_file",
        data: {
          id_temp: $("#file_temp").val(),
        },
        dataType: "json",
        success: function (response) {
          if (response.status == "ok") {
            $("#file_temp").val("");
            toastr.success("Archivo eliminado correctamente", "Notificación");
          } else {
            toastr.error("Error al eliminar el archivo", "Notificación");
          }
        },
      });
    }
  },
});
$(".import").on("click", function () {
  if ($("#file_temp").val() != "") {
    $.ajax({
      type: "POST",
      url: URL + "super/change_imagen",
      data: {
        id_temp: $("#file_temp").val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "ok") {
          $("#file_temp").val("");
          toastr.success(
            "Logo Subido Correctamente correctamente<br/>Vuelve a Iniciar Sesión para que se vean los cambios.",
            "Notificación"
          );
          actualiza_credenciales();
          window.location.reload();
        } else {
          toastr.error("Error", "Notificación");
        }
      },
    });
  } else {
    toastr.error("Sube un archivo primero", "Notificación");
  }
});
$("#mensaje_bienvenida").on("keyup", function (e) {
  let length = $("#mensaje_bienvenida").val().length;
  if (length <= 400 && length >= 0) {
    $("#frm_help").css("color", "green");
  } else {
    $("#frm_help").css("color", "red");
  }
  $("#frm_help").html(`${length} - 500 Carácteres`);
});
$(".btn-guardar-app").on("click", function (e) {
  let data = {
    app_name: $("#app_name").val(),
    mensaje_bienvenida: $("#mensaje_bienvenida").val(),
    number_wsp: $("#number_wsp").val(),
    number_sms: $("#number_sms").val(),
    mensaje_default: $("#mensaje_default").val(),
  };
  console.log(data)
  if (data.app_name != "" && data.mensaje_bienvenida != "" && data.number_wsp && data.number_sms != '') {
    $.ajax({
      type: "POST",
      url: URL + "super/crud_credentials/app",
      data: data,
      dataType: "json",
      success: function (response) {
        if (response.status == "ok") {
          toastr.success(
            "Atributos de la Aplicación Actualizados.",
            "Notificación"
          );
          actualiza_credenciales();
          window.location.reload();
        } else {
          toastr.error("Error", "Notificación");
        }
      },
    });
  } else {
    toastr.error("Rellena todos los campos", "Notificación");
  }
});
$(".btn-guardar-api").on("click", function(){
    let data = {
        token_twilio: $("#token_twilio").val(),
        ssid_twilio: $("#ssid_twilio").val(),
        wheather_key: $("#wheather_key").val(),
        messaging_service: $("#messaging_service").val(),
    };
    
    if (data.token_twilio != "" && data.ssid_twilio != "" && data.wheather_key && data.messaging_service) {
        $.ajax({
          type: "POST",
          url: URL + "super/crud_credentials/api",
          data: data,
          dataType: "json",
          success: function (response) {
            if (response.status == "ok") {
              toastr.success(
                "Atributos de la API Actualizados.",
                "Notificación"
              );
              actualiza_credenciales();
              window.location.reload();
            } else {
              toastr.error("Error", "Notificación");
            }
          },
        });
      } else {
        toastr.error("Rellena todos los campos", "Notificación");
      }
})
const open_modal_app = ()=>{
    $("#modal_app").modal("show");
}
const open_modal_api = ()=>{
    $("#modal_api").modal("show");
}