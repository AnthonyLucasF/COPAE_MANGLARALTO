<?php
    require('sesion.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="styles/style_EventosyEmergencias.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div>
        <div class="container">
            <div class="welcome-banner">
                <h1 id="mensajeBienvenida">¡Bienvenidos!</h1>
                <p>Aqui podrán elegir que tipo de evento o emergencia desea registrar</p>
            </div>
            
            <div class="main-content">
                <h2>Selecciona una opción: </h2>
                <button class="registrar-btn" onclick="registrarEvento()"><i class="fas fa-exclamation-triangle"></i> Registrar Evento</button>  
                <button class="registrar-btn" onclick="registrarEmergencia()"><i class="fas fa-exclamation-circle"></i> Registrar Emergencia</button>
                <button class="btn-danger" onclick="cerrarSesion()"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
            </div>
        </div>
    </div>
    <script src="scripts/script_EventosyEmergencias.js"></script>
    <script src="scripts/jquery-3.4.1.min.js"></script>
</body>
</html>

