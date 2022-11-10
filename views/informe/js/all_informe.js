const data = {
  id_district: "",
  fechaInicio: "",
  fechaFin: ""
}

$(function() {
  $('input[name="daterange"]').daterangepicker({
    autoUpdateInput: false,
    opens: 'left',
    locale: {
      "format": "DD/MM/YYYY",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "fromLabel": "Del",
      "toLabel": "Hasta",
      "customRangeLabel": "Rango",
      "daysOfWeek": [
          "Dom",
          "Lun",
          "Mar",
          "Mie",
          "Jue",
          "Vie",
          "Sab"
      ],
      "monthNames": [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
      ],
      "firstDay": 0
  }
  })

  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    data.fechaInicio = picker.startDate.format('YYYY-MM-DD')
    data.fechaFin = picker.endDate.format('YYYY-MM-DD')
  });

  $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    data.fechaInicio = ""
    data.fechaFin = ""
});

});

$(".export-pdf").on("click", ()=>{
    let id_district =  $("#id_district").selectpicker('val')    
    data.id_district = id_district
    if(data.id_district === "" || data.fechaInicio === "" || data.fechaFin === ""){
      Swal.fire({
        title: 'Alerta',
        html: 'Rellena todos los campos requeridos',
        icon: 'error'
      })
      return
    }
    $.ajax({
        type: "POST",
        url: URL + "informe/spInforme",
        data: data,
        dataType: 'json',
        success: (response)=>{
          if(response.data){
            if(response.data.length > 0){
              let ln = response.data.length
              toastr.success("Enhorabuena, se encontraron " + ln + " registros!", "Notificación")
              toastr.info("Generando pdf...", "Notificación")
              let json = response.data;
              window.open(URL + "informe/generar/" + data.id_district + '/' + data.fechaInicio + '/' + data.fechaFin + '/' ,'_blank')
            }
          }else{
            if(response.error){
              toastr.error(response.msj, 'Sin datos')
            }
          }
        }
      })
       
})