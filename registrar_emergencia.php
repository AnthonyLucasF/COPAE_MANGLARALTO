<?php
    require('copae.php');
    $id = $_POST['idV'];
    $lugar = $_POST['lugarSuceso'];
    $descripcion = $_POST['descripcion'];
    $file = $_FILES['foto']["name"]; 
    $url_temp = $_FILES['foto']["tmp_name"];
    echo $id, $lugar, $descripcion, $file;
    $url_insert = dirname(__FILE__) . "/img"; 

    $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

    if (!file_exists($url_insert)) {
        mkdir($url_insert, 0777, true);
    };

    if (move_uploaded_file($url_temp, $url_target)) {
        echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
        echo htmlspecialchars(basename($file));
    } else {
        echo "Ha habido un error al cargar tu archivo.";
    }

    $INSERT2 = "INSERT INTO  registroemergencia(`PERS_ID`, `TIPE_ID`,`EME_LUGAR`, `EME_IMG`, `EME_ESTADO`)  values ('$id', '$descripcion', '$lugar', '$file', 'A')";
    $resultado1 = $mysqli->query($INSERT2);
    
    echo '<script type="text/javascript">
            alert("Evento registrado con éxito");
            window.location.href ="EventosyEmergencias.php";
            </script>';

?>
