<?php
require('sesion.php');  
require('copae.php');

$sql2 = "SELECT * FROM tipoemergencias";
$resultado2 = $mysqli->query($sql2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Emergencias</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('img_copae/15.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        .sombra {
            position: fixed;
            top: 0;
            left: 0;
            width: 200vw; 
            height: 200vh; 
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
            pointer-events: none; 
        }

        #header {
            color: #fff;
            padding: 20px;
            width: 100%;
            text-align: center;
        }

        #content {
            margin-top: 20px;
            background-color: #798d77;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #36704f;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .button {
            display: block;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #f1f1f1;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: 1px solid #b6b6b6;
            text-align: center;
        }

        .button:hover {
            background-color: #36704f;
            color: #fff;
        }

        @media (max-width: 768px) {
            #content {
                padding: 15px;
                margin-top: 10px;
                width: 95%;
            }

            th, td {
                font-size: 14px;
                padding: 8px;
            }

            img {
                max-width: 80px;
            }

            .button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0 10px;
            }

            #content {
                padding: 10px;
                width: 100%;
            }

            th, td {
                font-size: 12px;
                padding: 6px;
            }

            img {
                max-width: 60px;
            }

            .button {
                padding: 6px 12px;
                font-size: 12px;
            }

            #header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>Listado de Emergencias</h1>
    </div>

    <div class="sombra"></div>

    <div id="content">
        <form method="post">
            <label for="tipoevento">Selecciona un tipo de emergencia:</label>
            <select name="id_tipoem" id="id_tipoem">
                <option selected disabled>Seleccionar...</option>
                <?php
                while ($row = $resultado2->fetch_assoc()) {
                    echo "<option value='" . $row['TIPE_ID'] . "'>" . $row['TIPE_DESCRIPCION'] . "</option>";
                }
                ?>
            </select>
            <input class="button" type="submit" value="Cargar datos"/>
        </form>

        <?php
        if(isset($_POST['id_tipoem'])) {
            $idTipoEmergencia= $_POST['id_tipoem'];
            $sql = "SELECT * FROM registroemergencia r 
                    INNER JOIN persona p ON r.PERS_ID=p.PERS_ID 
                    INNER JOIN tipoemergencias t ON t.TIPE_ID=r.TIPE_ID 
                    WHERE r.TIPE_ID='$idTipoEmergencia'";
            $resultado = $mysqli->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Tipo</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido</th>";
                echo "<th>Lugar del suceso</th>";
                echo "<th>Imagen</th>";
                echo "</tr>";

                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['TIPE_DESCRIPCION'] . "</td>";
                    echo "<td>" . $row['PERS_NOMBRES'] . "</td>";
                    echo "<td>" . $row['PERS_APELLIDOS'] . "</td>";
                    echo "<td>" . (isset($row['EME_LUGAR']) ? $row['EME_LUGAR'] : '') . "</td>";
                    echo '<td><img src="img/' . $row['EME_IMG'] . '" alt="Imagen de emergencia"/></td>';
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No se encontraron resultados.</p>";
            }
        }

        $mysqli->close();
        ?>
    </div>

    <a href="GadManglaraltoCOPAE.php" class="button">Regresar</a>
</body>
</html>
