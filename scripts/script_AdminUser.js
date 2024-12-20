$(document).ready(function () {
    $('#loginAdminButton').on('click', function () {
        console.log('Botón de inicio de sesión del administrador clickeado');

        var username = $('#username').val();
        var password = $('#password').val();

        if (username === '' || password === '') {
            alert('Por favor, rellene todos los campos.');
            if (username === '') {
                document.getElementById('username').focus();
            } else {
                document.getElementById('password').focus();
            }
        } else {
                usuario: username;
                contrasena: password
        }

        $.ajax({
            type: 'POST',
            url: 'login_Admin.php',
            data: { usuario: username, contrasena: password },
            success: function (response) {
                console.log('Respuesta completa del servidor:', response);

                if (isValidJSON(response)) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        console.log('Redirigiendo a GadManglaraltoCOPAE.html');
                        window.location.href = 'GadManglaraltoCOPAE.html';
                    } else {
                        console.log('Mostrando mensaje de error:', result.message);
                    }
                } else {
                    console.log('La respuesta no es un JSON válido:', response);
                }
            },
            error: function (error) {
                console.log('Error en la solicitud AJAX:', error.statusText);
            }
        });
    });

    

          $('#btnobtenereventos').on('click', function () {
        window.location.href = 'obtener_eventos.php';
    });

    $('#btnobteneremergencias').on('click', function () {
        window.location.href = 'obtener_emergencias.php';
    });


    $('#btnCerrarSesion').on('click', function () {
        $.ajax({
            type: 'POST',
            url: 'cerrar_sesion.php',
            success: function () {
                window.location.href = 'indexlogin.php';
            },
            error: function (error) {
                console.error('Error en la solicitud AJAX para cerrar sesión:', error.statusText);
            }
        });
    });

     function isValidJSON(str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }
});