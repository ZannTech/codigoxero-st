function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}
$(function() {
    $("#select-clients").select2({
        data: users,
        matcher: matchCustom,
        minimumResultsForSearch: 10 // at least 20 results must be displayed
    })
});
$("#call").on("click", function(){
    var data = {
        user : $("#select-clients").val(),
        text: $("#saythis").val(),
    }   
    if(data.text != '' && data.user != ''){
        $.ajax({
            type: "POST",
            url: URL + "mensajeria/call",
            data:data,
            dataType: "json",
            success: function (response) {
                Swal.fire({
                    title: 'Información',
                    html : response.msj,
                    icon: 'info'
                }).then(()=>{
                    window.location.reload()
                })
            }
        });
    }else{
        Swal.fire({
            title: 'Error',
            html : 'Rellena todos los campos',
            icon: 'error'
        })
    }
})