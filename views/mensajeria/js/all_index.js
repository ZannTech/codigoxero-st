/// <reference path="../../../public/assets/js/vendor/jquery-3.6.0.js"/>
/// <reference path="../../../server/server_config.js"/>
let viewed = false;
$(document).ready(function () {
    $("#frm_help").css('color', 'green')
});
$("#frm_mensaje").on('keyup', function(e) {
    let length = $("#frm_mensaje").val().length;
    if (length <= 500 && length >= 0) {
        if (length >= 1) {
            option_select("#plantilla", "");

            $("#plantilla").attr('disabled', true);
            $("#plantilla").selectpicker('refresh');
        } else {
            option_select("#plantilla", "");

            $("#plantilla").attr('disabled', false);
            $("#plantilla").selectpicker('refresh');
        }
        $("#frm_help").css('color', 'green')
    }else{
        $("#frm_help").css('color', 'red')
    }
    $("#frm_help").html(`${length} - 500 Carácteres`)
})
const get_inf = async function(id) {
    let result
    try {
      result = await $.ajax({
        url: URL + "mensajeria/get_info_file/" + id,
        type: 'POST',
        dataType: 'json'
      })
      return result
    } catch (error) {
      console.error(error)
    }
  }
$(".send-message").on("click", async ()=>{
    const file = await get_inf($("#url_file").val());
    console.log(file)
    let data = {
        message: $("#frm_mensaje").val(),
        id_zone: $("#id_zone").length ?  $("#id_zone").selectpicker('val') : '',
        file : $("#url_file").val() != '' ? file.data.server_route : '',
        input_contacts : $("#input_imp").length ? $("#input_imp").val() : '',
        type_send: $("input[name=type_msj]:checked").val(),
        default: $("#default_message").is(':checked') ? 1 : 0,
        delay: $("#delay").val(),
        msx: $("#msx").val(),
        lada_phone: $("#lada_phone").length ? $("#lada_phone").selectpicker('val') : '',
        plantilla: $("#plantilla").selectpicker('val')
    }
    console.log(data)
    if((data.message != '' || data.file != '' || data.default != 0 ||data.plantilla != '') && (data.id_zone != "" || data.input_contacts != "" && data.lada_phone != '') && data.type_send != undefined && data.delay != ''){
        if(data.message.length <= 500){
            Swal.fire({
            title: '¿Estás seguro de enviar el mensaje?',
            html: 'Se procederá a enviar un mensaje a todos los usuarios registrados en la zona indicada <br><h2>¿Deseas enviarlo?</h2>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#34d16e',
            confirmButtonText: 'Si, Adelante!',
            cancelButtonText: "No!",
            allowOutsideClick: false,
            allowEscapeKey : false,
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                      type: "POST",
                      url: URL + "mensajeria/send_message",
                      data: data,
                      dataType: 'json',
                    })
                      .done(function(response){
                        if(response.status == 'ok'){
                          Swal.fire({
                            title: 'Notificación',
                            html: response.msj,
                            icon: 'success'
                          }).then(()=>{
                            window.location.reload()
                          })
                        }else{
                          if(response.error){
                            Swal.fire({
                              title: 'Error',
                              html: response.msj,
                              icon:'error'
                            })
                          }
                        }
                    })
                    .fail(function(){
                        Swal.fire('Oops...', 'Problemas con la conexión a internet!', 'error');
                    });
                });
            }             
        });
        }else{
            Swal.fire({
                title: 'Alerta',
                html: 'Máximo de carácteres permitido '  ,
                icon: 'error'
            })
        }
    }else{
        Swal.fire({
            title: 'Alerta',
            html: 'Rellena todos los campos requeridos',
            icon: 'error'
        })
    }
})

$(".select-file").on("click", ()=>{
  $("#modal_files").modal("show")
})

$(".select-imp").on("click", ()=>{
    $("#modal_imp").modal("show")
})

const select_file = (url, id)=>{
  let is_the_same = url ==  $("#src_file").val() ? true : false
  let ele = d.getElementsByClassName("file")

  for(var i = 0; i < ele.length; i++){
		ele[i].innerHTML = "Seleccionar";
	}
  if(is_the_same == false){
    let name = url.replace(URL +'public/files/uploads/', '', url)
    $("#file_"+id).html("Deseleccionar")
    $("#src_file").val(url)
    $("#selected_file").html(`<div class="alert alert-info" role="alert">
    Seleccionaste el archivo: <strong><a target="_blank" href="${url}">${name}</a></strong>
    </div>`)
  }else{
    $("#src_file").val("")
    $("#selected_file").html(``)

  }
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
            $("#url_file").val(json.msj)
            $(".select-file").attr('disabled', true)
            lista_datos()

        } else {
            toastr.error(json.msj, "Notificación");
        }
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if ($("#url_file").val() != "") {
            $.ajax({
                type: "POST",
                url: URL + 'service/delete_file_msj',
                data: {
                    id_temp: $("#url_file").val()
                },
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        $("#url_file").val('')
                        toastr.success("Archivo eliminado correctamente", "Notificación");
                    } else {
                        toastr.error("Error al eliminar el archivo", "Notificación");
                    }
                }
            });
        }
    }
});
$("#modal_files").on("hidden.bs.modal", function (e) {
    var xDrop = Dropzone.forElement("form.dropzone");
    xDrop.removeAllFiles(false);
    $("#file_temp").val('')
})


Dropzone.autoDiscover = false;
let myDropzoneImp = new Dropzone("form.dimp", {
    dictDefaultMessage: 'Selecciona el archivo (xlsx, xls o csv) de contactos.',
    url: URL + "service/upload_file",
    paramName: 'file',
    addRemoveLinks: true,
    dictRemoveFileConfirmation: 'Estás seguro de quitar el archivo de la lista?',
    maxFiles: 1,
    acceptedFiles: ".csv, .xlsx, .xls",
    maxFilesize: 100,
    complete: (e) => {
        let json = JSON.parse(e.xhr.response)
        if (json.status == 'ok') {
            toastr.success("Archivo subido correctamente", "Notificación");
            $("#modal_imp").modal("hide")
            $("#input_imp").val(json.msj);
            $("#id_zone").attr("disabled", "true");
            $("#id_zone").selectpicker('refresh')
            $("#info").html(`<div class="alert alert-success" role="alert">
                <strong>Has seleccionado un archivo de contactos, se mandará mensajes a los contactos en el archivo. <br/>Si deseas usar variables encierra entre {{ }} las columnas que deseas que sean dinamicas. <br/>Ejemplo: nombre : {{nombre}}</strong>
            </div>`)
            console.log(json);
        } else {
            toastr.error(json.msj, "Notificación");
        }
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if ($("#file_temp").val() != "") {
            $.ajax({
                type: "POST",
                url: URL + 'service/delete_file',
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
$("#modal_imp").on("hidden.bs.modal", function (e) {
    var xDrop = Dropzone.forElement("form.dimp");
    xDrop.removeAllFiles(false);
    $("#file_temp").val('')
})


$("#default_message").on("change", function (event) { 
    if ($("#default_message").is(':checked')) {  
        option_select("#plantilla", "");
        $("#plantilla").attr('disabled', true);
        $("#plantilla").selectpicker('refresh');
        $("#message-container").fadeOut('fast');
    } else {  
        option_select("#plantilla", "");

        $("#plantilla").attr('disabled', false);
        $("#plantilla").selectpicker('refresh');
        $("#message-container").fadeIn('fast');
    }
})