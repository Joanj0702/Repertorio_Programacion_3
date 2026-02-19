<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "1234", "Universidad");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se recibió el parámetro GET
/** @var type $_GET */
if (isset($_GET['curso'])) {
    $curso = $_GET['curso'];

    // Consulta usando WHERE
    $sql = "SELECT * FROM Estudiantes WHERE curso = '$curso'";
    $resultado = $conexion->query($sql);
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Estudiantes</title>
        <style>
            body{
                font-family: sans-serif;
                text-align: center;
            }

            table{
                margin: auto;
                border-collapse: collapse;
                width: 70%;
            }

            table, th, td{
                border: 1px solid black;
            }

            th{
                background-color: #d3d3d3;
                padding: 10px;
            }

            td{
                padding: 10px;
            }

            .aprobado{
                color: green;
                font-weight: bold;
            }

            .reprobado{
                color: red;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <?php
if (isset($resultado)) {

    if ($resultado->num_rows > 0) {

        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Curso</th>
                <th>Nota</th>
              </tr>";

        while($fila = $resultado->fetch_assoc()) {

            $clase = ($fila['nota'] >= 70) ? "aprobado" : "reprobado";

            echo "<tr>";
            echo "<td>".$fila['id']."</td>";
            echo "<td>".$fila['nombre']."</td>";
            echo "<td>".$fila['curso']."</td>";
            echo "<td class='$clase'>".$fila['nota']."</td>";
            echo "</tr>";
        }

        echo "</table>";

    } else {
        echo "<p>No se encontraron estudiantes para este curso.</p>";
    }

} else {
    echo "<p>Debe ingresar un curso en la URL.</p>";
}

$conexion->close();
?>

    </body>

</html>

