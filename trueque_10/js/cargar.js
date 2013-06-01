function readURL(input) {
    var str = $("#imagen").val();
    $("#filename").text(str);
    if ( input.files && input.files[0] ) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagenProducto img').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}


