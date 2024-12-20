<?php 
    $mysqli = new mysqli("bj4zytp3t77ke6exs6hv-mysql.services.clever-cloud.com", "uzhx1k6b32yevxal", "OXE6iSc6O4pzcGpsEMsM", "copae");

    if ($mysqli->connect_error) {
        die("Error de conexión a la base de datos: " . $mysqli->connect_error);
    }