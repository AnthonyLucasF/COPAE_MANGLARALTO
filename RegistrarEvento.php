<?php
    session_start();
    require('copae.php');
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $direccion = $_SESSION['descripcion'];
    $cedula=$_SESSION['cedula'];
    $id = $_SESSION['idU'];

    $sql = "SELECT TIPV_ID, TIPV_DESCRIPCION, TIPV_ESTADO FROM tipoeventos WHERE TIPV_ESTADO='A'";
    $result = mysqli_query($mysqli, $sql); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Evento</title>
    <link rel="stylesheet" href="styles/style_RegistrarEvento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <section class="registro-evento">
        <h2>Registrar Evento</h2>
        <form enctype="multipart/form-data" id="registro" name="registro" action="registrar_evento.php" method="post">
            <input type="text" style="display:none;" id="idV" name="idV" value="<?php echo $id; ?>">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" readonly>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" readonly>

            <label for="lugarSuceso">Lugar del Suceso:</label>
            <input type="text" id="lugarSuceso" name="lugarSuceso" required>

            <div class="form-group">
                <label for="descripcion">Seleccione el Evento:</label>
                <select id="descripcion" name="descripcion" required>
                    <option selected disabled>Seleccionar... </option>
                    <?php while($fila1 = $result->fetch_assoc()) { ?>
                        <option  value="<?php echo $fila1['TIPV_ID']?>"><?php echo $fila1['TIPV_DESCRIPCION']?></option>
                    <?php } ?>
                </select>
            </div>
            <label for="foto">Subir Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <button type="submit" id="registrarBtn"><i class="fas fa-exclamation-triangle"></i> Registrar Evento</button>
            <button type="button" id="regresarBtn"><i class="fas fa-arrow-left"></i> Regresar</button>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.getElementById("regresarBtn").addEventListener("click", function() {
            window.location.href = "EventosyEmergencias.php";
        });
    </script>

</body>
</html>
