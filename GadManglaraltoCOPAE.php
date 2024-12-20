<?php
require('sesion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Inicio - Admin GadManglaralto</title>
    <link rel="stylesheet" href="styles/style_AdminUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div>
        <div class="container">
            <div id="bienvenida">
                <h1>Bienvenido al Panel de Administración</h1>
                <p>¡Gestiona eventos y emergencias de manera fácil y rápida!</p>
            </div>
        
            <div class="main-content">
                <div id="accionesAdmin">
                    <h1>Interfaz de Gestión</h1>
                    <div id="botonesAdmin">
                        <button id="btnobtenereventos" class="registrar-btn"><i class="fas fa-exclamation-triangle"></i>Mostrar Eventos</button>
                        <button id="btnobteneremergencias" class="registrar-btn"><i class="fas fa-exclamation-circle"></i>Mostrar Emergencias</button>
                        
                        <button id="btnCerrarSesion" class="btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/script_AdminUser.js"></script>
</body>
</html>
