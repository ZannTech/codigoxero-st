$(function () {
    lista_datos();
});
function lista_datos() {
    function filterGlobal() {
        $("#table").DataTable().search($(".global_filter").val()).draw();
    }
    var table = $("#table").DataTable({
        ajax: {
            url: URL + "mensajeria/get_errores",
            method: "POST",
        },
        destroy: true,
        responsive: true,
        dom: "tip",
        bSort: true,
        order: [[0, "asc"]],
        
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        `<b>${data.number}</b>`
                    );
                },
            },
            
        ],
       
    });
    $("input.global_filter").on("keyup click", function () {
        filterGlobal();
    });
}
