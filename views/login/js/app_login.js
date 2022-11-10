/// <reference path="../../../public/assets/js/vendor/jquery-3.6.0.js" />
/// <reference path="../../../server/server_config.js" />

d.addEventListener("DOMContentLoaded", () => {
  if(sessionStorage.getItem('fill_field') != ''){
    let usu = sessionStorage.getItem('fill_field');
    $("#gp_1").addClass('focused');
    $("#frm_user").val(usu)
    
  }
  $("#frm_login").on("submit", (e) => {
    e.preventDefault();
    let data = {
      user: $("#frm_user").val(),
      password: $("#frm_password").val(),
    };
    if (data.password != "" && data.user != "") {
      let rem =  $("#frm_remember").prop("checked") ? 1 : 0
      $.ajax({
        type: "POST",
        url: URL + "authentication/auth_login",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status) {
            if(rem == 1){
              sessionStorage.setItem('fill_field', data.user);
            }else{
              if(sessionStorage.getItem('fill_field') != ''){
                sessionStorage.setItem('fill_field', '');
              }
            }
            Swal.fire({
              title: "Acceso",
              html: response.msj,
              icon: 'success',
              timer: 1500,
              timerProgressBar: true,
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
              showCancellButton: false,
            }).then((result) => {
                window.location.replace(URL + 'principal/');            
            });
          } else {
            clean_inputs();
            Toast.fire({
              title: "Error",
              html: response.msj,
              icon: "error",
            }).then(() => {});
          }
        },
      });
    } else {
      Toast.fire({
        title: "Error",
        html: "Rellena todos los datos",
        icon: "error",
      });
    }
  });
});

const clean_inputs = () => {
  $("#frm_user").val("");
  $("#frm_password").val("");
  $(".form-gp").removeClass("focused");
};
