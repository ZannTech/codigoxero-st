$(function () {
    actualiza_credenciales()
});

const actualiza_credenciales = ()=>{
    $.ajax({
        type: "POST",
        url: URL + "service/get_credentials/",
        dataType: "json",
        success: function (response) {
           if(response.error){
            if($("#is_settings").val()){
            }else{
                Swal.fire({
                    title: 'Error',
                    html: response.msj,
                    icon: 'error',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    backdrop: "#00000"
                })
            }
           }
        }
    });
}