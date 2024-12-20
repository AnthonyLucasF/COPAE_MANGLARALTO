<?php
require('copae.php');

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$lugar = $_POST['lugar'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$usuario = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (!preg_match('/^\d{10}$/', $cedula)) {
    echo '<script type="text/javascript">
            alert("Error: La cédula debe tener exactamente 10 dígitos y solo contener números.");
            window.location.href ="registro.html";
          </script>';
    exit();
}

$sql_cedula = "SELECT * FROM persona WHERE PERS_CEDULA = '$cedula'";
$result_cedula = mysqli_query($mysqli, $sql_cedula);

if (mysqli_num_rows($result_cedula) > 0) {
    echo '<script type="text/javascript">
            alert("Error: Ya existe un usuario registrado con esta cédula.");
            window.location.href ="registro.html";
          </script>';
    exit();
}

$sql_username = "SELECT * FROM usuarios WHERE USU_USUARIO = '$usuario'";
$result_username = mysqli_query($mysqli, $sql_username);

if (mysqli_num_rows($result_username) > 0) {
    echo '<script type="text/javascript">
            alert("Error: El nombre de usuario ya está en uso. Por favor, elige otro.");
            window.location.href ="registro.html";
          </script>';
    exit();
}

$insert_persona = "INSERT INTO persona (PERS_CEDULA, PERS_NOMBRES, PERS_APELLIDOS, PERS_DIRECCION, PERS_TELEFONO, PERS_CORREO, PERS_ESTADO) 
                   VALUES ('$cedula', '$nombre', '$apellido', '$lugar', '$telefono', '$mail', 'A')";
$resultado_persona = mysqli_query($mysqli, $insert_persona);

if ($resultado_persona) {
    $persona_id = $mysqli->insert_id;

    $insert_usuario = "INSERT INTO usuarios (USU_USUARIO, USU_CLAVE, PER_ID, PERS_ID, USU_ESTADO) 
                       VALUES ('$usuario', '$password', 2, '$persona_id', 'A')";
    $resultado_usuario = mysqli_query($mysqli, $insert_usuario);

    if ($resultado_usuario) {
        echo '<script type="text/javascript">
                alert("El usuario ha sido creado con éxito.");
                window.location.href ="indexlogin.php";
              </script>';
    } else {
        echo '<script type="text/javascript">
                alert("Error: Hubo un problema al crear el usuario. Inténtalo nuevamente.");
                window.location.href ="registro.html";
              </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Error: Hubo un problema al registrar la información personal. Inténtalo nuevamente.");
            window.location.href ="registro.html";
          </script>';
}
?>
