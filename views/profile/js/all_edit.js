$("#submit").on("click", ()=>{
    let data = {
        nombre: $("#nombre").val(),
        usuario: $("#usuario").val(),
        pwd: $("#pwd").val()
    }
    if(data.nombre != '' && data.usuario != '' && data.pwd != '' ){
        $.ajax({
            type: "POST",
            url: URL + "usuario/profile_edit",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 'ok'){
                    Swal.fire({
                        title: 'Correcto',
                        html: response.msj,
                        icon: 'success'
                    }).then(()=>{
                        window.location.reload();
                    })
                }
            }
        });
    }else{
        Swal.fire({
            title: 'Error',
            html: 'Rellena todos los campos',
            icon: 'error'
        })
    }
})