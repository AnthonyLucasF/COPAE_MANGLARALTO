$('#registrarBtn').click(function () {
    var cedula = $('#cedula').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var lugarSuceso = $('#lugarSuceso').val();
    var descripcion = $('#descripcion').val();
    var foto = $('#foto')[0].files[0];

    if (lugarSuceso && descripcion && foto) {
        var formData = new FormData();
        formData.append('cedula', cedula);
        formData.append('nombre', nombre);
        formData.append('apellido', apellido);
        formData.append('lugarSuceso', lugarSuceso);
        formData.append('descripcion', descripcion);
        formData.append('foto', foto);

        $.ajax({
            type: 'POST',
            url: 'registrar_emergencia.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response.trim() === 'Registro exitoso') {
                    $('#lugarSuceso').val('');
                    $('#descripcion').val('');
                    $('#foto').val('');

                    alert('¡Registro exitoso!');
                } else {
                    alert('Error al registrar la emergencia: ' + response);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
                console.log(xhr.responseText);
            }
        });
    } else {
        console.error("Error: Todos los campos requeridos deben estar llenos.");
    }
});

