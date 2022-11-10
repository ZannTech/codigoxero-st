class Auth {
  static Logout = () => {
    Swal.fire({
      title: "Cerrar Sesión",
      html: "¿Estás seguro de cerrar la sesión actual?",
      icon: "question",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonText: "Cerrar Sesión",
      showLoaderOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve) {
          $.ajax({
            type: "POST",
            url: URL + "authentication/logout",
            data: {
              data: Math.random(),
            },
          })
            .done(function (response) {
              window.location.replace(URL);
            })
            .fail(function (e) {
              Swal.fire(
                "Oops...",
                "Problemas con la conexión a internet!",
                "error"
              );
            });
        });
      },
    });
  };
}
$(function () {
  $(".logout-actioner").on("click", function () {
    Auth.Logout();
  });
});

function option_select(selector, value){
  $(selector).selectpicker('val', value)
}



const download_file = (url) =>{
  $.fileDownload(url)
  .done(function () { toastr.success("Archivo Descargado correctamente", 'Notificación'); })
  .fail(function () { toastr.error("Error al descargar el archivo","Error"); });
}