$(".check").on("click", ()=>{
    let data = {
        instance: $("#instance").val(),
        token: $("#token").val()
    }
    if (data.instance != '' && data.token != '') {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": $("#send_test_request_form").attr("action"),
            "method": "GET",
            "headers": {
              "content-type": "application/x-www-form-urlencoded"
            }
          }
          $.ajax(settings).done(function (response) {
            if(response.error){
                toastr.error("Ya has iniciado sesión en Whatsapp, puedes usar la aplicación")
            }else{
                $(".qr-").css("display","block")
                loadImage();    
            }
          });          
    }else{
        toastr.error("Campos vacíos detectados, rellena todos los campos")
    }
})
const loadImage = () => { 
    let data = {
        instance: $("#instance").val(),
        token: $("#token").val(),
        action :  $("#send_test_request_form").attr("action")
    }
    $(".qr").empty()
    $(".qr").html(`<img src="${data.action}">`)
      setInterval(()=>{
        $(".qr").empty()
        $(".qr").html(`<img src="${data.action}">`)
      }, 10000)
    
}
$("#instance, #token").on("keyup", ()=>{
    let data = {
        instance: $("#instance").val(),
        token: $("#token").val()
    }
    $("#send_test_request_form").attr("action", `https://api.ultramsg.com/${data.instance}/instance/qr?token=${data.token}`);
})
$(".save").on("click", () => {
    let data = {
        instance: $("#instance").val(),
        token: $("#token").val()
    }
    if (data.instance != '' && data.token != '') {
        $.ajax({
            type: "POST",
            url: URL + 'mensajeria/config_save',
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'success'
                    }).then(() => {
                        window.location.reload()
                    })
                } else {
                    if (response.error) {
                        Swal.fire({
                            title: 'Error',
                            html: response.msj,
                            icon: 'error'
                        })
                    }
                }
            }
        });
    } else {
        toastr.error("Campos vacíos detectados, rellena todos los campos")
    }
})