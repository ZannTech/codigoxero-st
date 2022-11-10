$(document).ready(function () {
    $(".card").matchHeight();
});
function replace_window(url){
    window.location.replace($("#url").val() + 'gestion/' + url)
}
