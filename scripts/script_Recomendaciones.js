function cargarImagen(id, rutaImagen) {
    $.ajax({
        type: 'GET',
        url: rutaImagen,
        success: function() {
            $('#' + id).html('<img src="' + rutaImagen + '" alt="' + id + '">');
        },
        error: function() {
            console.log('Error al cargar la imagen: ' + rutaImagen);
        }
    });
}
$(document).ready(function() {
    $('#primerosAuxiliosLink').attr('href', 'https://cruzroja.org.ec/wp-content/uploads/2018/04/MANUAL-PAB-2019.pdf');
});

$(document).ready(function() {
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/') + 1);
    
    if (filename === "index.html") {
        $('a[href="index.html"]').addClass('active');
    } else if (filename === "recomendaciones.html") {
        $('a[href="recomendaciones.html"]').addClass('active');
    }
});