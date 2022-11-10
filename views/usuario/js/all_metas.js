$(function () {
    var org_buildButton = $.fn.DataTable.Buttons.prototype._buildButton;
    $.fn.DataTable.Buttons.prototype._buildButton = function (
        config,
        collectionButton
    ) {
        var button = org_buildButton.apply(this, arguments);
        $(document).one("init.dt", function (e, settings, json) {
            if (config.container && $(config.container).length) {
                $(button.inserter[0]).detach().appendTo(config.container);
            }
        });
        return button;
    };
    lista_datos();
    $("#cant").mask("000000000000");
});

function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "usuario/get_metas_new",
            method: "POST",
        },
        destroy: true,
        responsive: true,
        dom: "tip",
        bSort: true,
        order: [[0, "asc"]],
        buttons: [
            {
                extend: "pdf",
                title: "REPORTE DE METAS",
                className: "btn btn-outline-danger btn-rounded col-auto mr-4",
                text: "PDF",
                text: '<i class="mdi mdi-file-pdf-box"></i>',
                titleAttr: "Descargar PDF",
                container: "#pdf_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: "excel",
                title: "REPORTE DE METAS",
                text: "Excel",
                className: "btn btn-outline-success btn-rounded col-auto mr-4",
                text: '<i class="mdi mdi-file-excel-outline"></i>',
                titleAttr: "Descargar Excel",
                container: "#excel_btn",
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
        ],
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        '<i class="mdi mdi-calendar"></i> ' +
                        moment(data.meta.date_start).format("DD-MM-Y")
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return data.meta.date_end != null ?  '<i class="mdi mdi-calendar"></i> ' +
                    moment(data.meta.date_start).format("DD-MM-Y") : '-'
                    
                },
            },
            
            {
                data: null,
                render: function (data, type, row) {
                    return `<span class="badge badge-success">${data.type}</span>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<span class="badge badge-success">${data.detalle.description}</span>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.encargado.nombre}</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.meta.cant_proposal} PERSONAS</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<b>${data.report.c} PERSONAS</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let p = data.meta.cant_proposal - data.report.c 
                    p = p < 0 ? '0' : p
                    return `<b>${(p)} PERSONAS</b>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let pct = (100 * data.report.c) / data.meta.cant_proposal;
                    pct = pct >= 100 ? 100.00 : pct;
                    let class_name = '';
                    switch(true){
                        case pct < 20: 
                            class_name = 'bg-danger'
                        break;
                        case pct > 20 && pct < 70:
                            class_name = 'bg-warning'
                        break;
                        case pct > 70 && pct < 99:
                            class_name = 'bg-primary'
                        break;
                        case pct == 100:
                            class_name = 'bg-success'
                        break;
                    }
                    return `
                    <div class="progress_area">
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar ${class_name} progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:${pct.toFixed(2)}%">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <span class="badge badge-success">${(pct.toFixed(2))}%</span>
                    </div>
                    `;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let pct = (100 * data.report.c) / data.meta.cant_proposal;
                    pct = pct >= 100 ? 100.00 : pct;
                    if(pct < 100){
                        return `
                        <div class="col-lg-12">
                            <button class="btn btn-outline-primary" onclick="crud_meta(${data.meta.id_meta},${data.meta.cant_proposal})" title="Editar Meta"><i class="mdi mdi-briefcase-edit-outline"></i></button>
                        </div>
                    `;
                    }else{
                        return `
                        <div class="col-lg-12">
                            <button class="btn btn-outline-primary" onclick="crud_meta(${data.meta.id_meta},${data.meta.cant_proposal})" title="Editar Meta"><i class="mdi mdi-briefcase-edit-outline"></i></button>
                            <button class="btn btn-outline-success" onclick="finish(${data.id_meta}, '${data.dni}')" title="Terminar Meta"><i class="mdi mdi-package-variant-closed-check"></i></button>
                        </div>
                    `;
                    }
                },
            },

        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(),
                data;
            usuarios = api.rows().data().count();
            $(".usuarios-count").text(usuarios);
        },
    });
    $("input.global_filter").on("keyup click", function () {
        filterGlobal();
    });
}
const crud_meta = (id_meta = '', cant = '')=>{
    limpia_campos();
    if(id_meta != ''){
        $(".frm_coord").hide();
        $("#cant").val(cant)
        $("#id_meta").val(id_meta);
        Modal.title_Change('Editar Meta')
    }else{
        $(".frm_coord").show();
        Modal.title_Change('Nueva Meta')
    }
    Modal.show()
}
const limpia_campos = ()=>{
    $("#id_meta").val('');
    option_select("#id_assign", '')
    $("#cant").val('')
}
class Modal {
    static modal = $("#modal")
    static title = $(".title_modal")
    static show(){
        this.modal.modal('show')
    }
    static hide(){
        this.modal.modal('hide')
    }
    static title_Change(text){
        this.title.html(text)
    }
}

$(".btn-guardar").on("click", ()=>{
    let data = {
        id : $("#id_meta").val(),
        meta: $("#cant").val(),
        id_assign : $("#id_assign").selectpicker('val')
    }
    let method = data.id == '' ? 'add' : 'edit'
    if((method == 'add' && data.id_coord != '' && data.meta != '') || (method == 'edit' && data.meta != '')){
        $.ajax({
            type: "POST",
            url: URL + 'usuario/crud_meta_new/',
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 'ok'){
                    toastr.success(response.msj, 'Notificación')
                    window.location.reload()
                    Modal.hide()
                }else{
                    if(response.error){
                        toastr.error(response.msj, 'Error')
                    }
                }
            }
        }); 
    }else{
        toastr.error("Favor de rellenar todos los campos requeridos", "Error")
    }
})
const finish = (id, dni)=>{
    Swal.fire({
        title: '¿Estás seguro de terminar la meta?',
        html: 'Se procederá a inabilitar la cuenta del coordinador, se podrá usar de nuevo si agregas una nueva meta.',
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
                  url: URL + "usuario/terminar_meta",
                  data: {
                    id_meta : id,
                    dni: dni
                  },
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
}