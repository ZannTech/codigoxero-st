
Dropzone.autoDiscover = false;
let myDropzone = new Dropzone("form.dropzone", {
    dictDefaultMessage: 'Selecciona el archivo .xlsx o .csv que desea importar',
    url: URL + "service/upload_file",
    paramName: 'file',
    addRemoveLinks: true,
    dictRemoveFileConfirmation: 'Estás seguro de quitar el archivo de la lista?',
    maxFiles: 1,
    acceptedFiles: ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel",
    maxFilesize: 2,
    complete: (e) => {
            let json = JSON.parse(e.xhr.response)
            if(json.status == 'ok'){
                toastr.success("Archivo subido correctamente", "Notificación");
                toastr.info("Para terminar la importación, da click en `Importar` ", "Notificación");
                $("#file_temp").val(json.msj)
                $(".import").attr("disabled", false);
            }else{
                toastr.error(json.msj, "Notificación");
            }
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if($("#file_temp").val() != ""){
            $.ajax({
                type: "POST",
                url: URL + 'service/delete_file',
                data: {
                    id_temp : $("#file_temp").val()
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 'ok'){
                        $("#file_temp").val('')
                        toastr.success("Archivo eliminado correctamente", "Notificación");
                    }else{
                        toastr.error("Error al eliminar el archivo", "Notificación");
                    }
                }
            });
        }
    }
});

 const drop_data_id =  (id, table) =>{
   Swal.fire({
    title:'¿Estás seguro de eliminar el dato seleccionado?',
    html:'Los datos se eliminarán permanentemente!<br/><h4>¿Desea continuar?</h4>',
    icon: 'question',
    showCancelButton: true,
    showConfirmButton: true,
   }).then((res)=>{
    if(res.isConfirmed == true){
        $.ajax({
            type: "POST",
           url: URL + 'gestion/delete_data/' + table,
            data: {
                id: id
            },
            cache: false,
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown + ' ' + textStatus);
            },
            success: (resp)=>{
                if(resp.status == 'ok'){
                    Swal.fire({
                        title: 'Correcto',
                        html : resp.msj,
                        icon: 'success'
                    }).then(()=>{
                        lista_datos();
                    })
                }else{
                    Swal.fire({
                        title: 'error',
                        html : resp.msj,
                        icon: 'error'
                    }).then(()=>{
                        lista_datos();
                    })  
                }
            },
            dataType: "json",
        });
    }
   })
 }