<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Consulta de noticias</h1>

<?php

include_once "conexion.php";

$con = new Conexion();

$con->conectar();

$result = $con->ejecutar_consulta("SELECT * FROM noticias");

$num_resultados = $result->num_rows;

echo "$num_resultados resultados.";

//Si hay resultados pintamos la tabla
if ($num_resultados > 0) {

    //Si no está vacío pintamos la tabla
    echo '<table>';
    echo '<th>Título</th>';
    echo '<th>Texto</th>';
    echo '<th>Categoria</th>';
    echo '<th>Fecha</th>';
    echo '<th>Imagen</th>';

    while ($row = $result->fetch_assoc()) {

        $id = $row['id'];
        $titulo = $row['titulo'];
        $texto = $row['texto'];
        $categoria = $row['categoria'];
        $fecha = $row['fecha'];
        $imagen = $row['imagen'];

        echo '<tr>';

        echo "<td>$titulo</td>";
        echo "<td>$texto</td>";
        echo "<td>$categoria</td>";
        echo "<td>$fecha</td>";

        if ($imagen) {
            echo "<td><a href='./imagenes/$imagen' target='_blank'><img src='./icono_imagen.png'></a></td>";
        } else {
            echo '<td></td>';
        }

        echo '</tr>';
    }


    echo '</table>';
}

?>

</body>
</html>