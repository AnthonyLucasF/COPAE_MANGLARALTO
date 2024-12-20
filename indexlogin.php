<?php
    session_start();
    if (isset($_POST['submit'])) {
        require('copae.php');
        
        $usuario = $_POST['username'];
        $clave = $_POST['password'];
        
        $stmt = $mysqli->prepare("
            SELECT i.PERS_NOMBRES, i.PERS_CEDULA, i.PERS_APELLIDOS, u.USU_USUARIO, u.USU_CLAVE, i.PERS_ID, p.PER_ID, i.PERS_DIRECCION 
            FROM usuarios u 
            INNER JOIN persona i ON u.PERS_ID = i.PERS_ID 
            INNER JOIN perfil p ON p.PER_ID = u.PER_ID 
            WHERE u.USU_USUARIO = ?
        ");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $fila = $result->fetch_assoc();
            if (password_verify($clave, $fila['USU_CLAVE'])) {
                $_SESSION['cedula'] = $fila['PERS_CEDULA'];
                $_SESSION['nombre'] = $fila['PERS_NOMBRES'];
                $_SESSION['apellido'] = $fila['PERS_APELLIDOS'];
                $_SESSION['descripcion'] = $fila['PERS_DIRECCION'];
                $_SESSION['idU'] = $fila['PERS_ID'];
                
                if ($fila['PER_ID'] == 1) {
                    header("Location: GadManglaraltoCOPAE.php");
                } elseif ($fila['PER_ID'] == 2) {
                    header("Location: EventosyEmergencias.php");
                }
                exit();
            } else {
                $_SESSION['login_error'] = "Nombre de usuario o clave inválida";
                header('Location: indexlogin.php');
                exit();
            }
        } else {
            $_SESSION['login_error'] = "Nombre de usuario o clave inválida";
            header('Location: indexlogin.php');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="styles/styleslogin.css">
    <script>
        window.onload = function() {
            var error = "<?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : ''; ?>";
            if (error) {
                alert(error);
                <?php unset($_SESSION['login_error']); ?>
            }
        };
    </script>
</head>
<body>
    <form class="form" id="ingreso" name="ingreso" method="post">
        <h2 class="form__title">Inicia Sesión</h2>
        <p class="form__paragraph">¿Aún no tienes una cuenta? <a href="registro.html" class="form__link">Regístrate aquí</a></p>
        
        <div class="form__container">
            <div class="form__group">
                <input type="text" id="username" name="username" class="form__input" placeholder=" " required autocomplete="off">
                <label for="username" class="form__label">Usuario:</label>
                <span class="form__line"></span>
            </div>
            <div class="form__group">
                <input type="password" id="password" name="password" class="form__input" placeholder=" " required autocomplete="off">
                <label for="password" class="form__label">Contraseña:</label>
                <span class="form__line"></span>
            </div>
            <button type="submit" name="submit">Iniciar Sesión</button>
            <p>¿Desea volver a la pagina anterior? <a href="GestiondeRiesgo.html">Volver</a></p>
        </div>
    </form>
    <script src="scripts/jquery-3.4.1.min.js"></script>
</body>
</html>
