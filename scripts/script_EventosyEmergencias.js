$(document).ready(function() {

    function toggleNav() {
        var navbar = document.getElementById("navbar");
        var welcomeMessage = document.getElementById("mensajeBienvenida");

        if (navbar.style.width === "250px") {
            navbar.style.width = "0";
            welcomeMessage.style.marginLeft = "0";
        } else {
            navbar.style.width = "250px";
            welcomeMessage.style.marginLeft = "250px";
        }
    }

    $('.menu-icon').on('click', toggleNav);

    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: 'obtener_usuario.php',
            dataType: 'json',
            success: function(response) {
                if (response.nombre) {
                    console.log("Nombre del usuario:", response.nombre);
                    $('#mensajeBienvenida').text('Bienvenido ' + response.nombre);
                } else {
                    console.log('Error al obtener el nombre de usuario');
                }
            },
            error: function(error) {
                console.log('Error en la solicitud AJAX:', error.statusText);
            }
        });
    });
});
    

function registrarEvento() {
    window.location.href = 'RegistrarEvento.php';
}

function registrarEmergencia() {
    window.location.href = 'RegistrarEmergencias.php';
}

function cerrarSesion() {
    window.location.href = 'cerrar_sesion.php';
}
