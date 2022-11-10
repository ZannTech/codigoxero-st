

const data = {
    fechaInicio: "",
    fechaFin: ""
  }
  
$(".sh-wg").on("click", () => {
    Swal.fire({
        title: "Que fecha deseas validar?",
        html: '<input class="form-control" type="text" name="daterange" value="" readonly />',
        icon: "question",
        confirmButtonColor: "red",
        confirmButtonText: "Generar PDF",
        customClass: 'swal2-overflow',
        didOpen: function () {
            console.log("Rendered")
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
            $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                data.fechaInicio = picker.startDate.format('YYYY-MM-DD')
                data.fechaFin = picker.endDate.format('YYYY-MM-DD')
            });

            $('input[name="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
                data.fechaInicio = ""
                data.fechaFin = ""
            });
        },
    }).then((result)=>{
        if(result.isConfirmed === true){
            $.ajax({
                type: "POST",
                url: URL + "informe/psgen",
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response.data){
                        Swal.fire({
                            title: "Reporte generado",
                            html: "Correcto, se ha encontrado un reporte",
                            icon:"success"
                        }).then(()=>{
                            window.open(URL + "informe/general/" + data.fechaInicio + '/' + data.fechaFin + '/' ,'_blank')
                        })
                    }else{
                        Swal.fire({
                            title: "Error",
                            html: response.msj,
                            icon:"error"
                        })
                    }
                }
            });
        }
    })
})

