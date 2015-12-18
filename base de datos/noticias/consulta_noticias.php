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

if (!$con = new mysqli("localhost", "root", "")) {
    echo "Se ha producido un error de conexion";
    die();
}

$con->set_charset("UTF8");


if (!$con->select_db("curso")) {
    echo "Se ha producido un error de conexion a la base de datos";
    die();
}

$consulta = "SELECT * FROM noticias";

if (!$result = $con->query($consulta)) {
    echo "Se ha producido un error al ejecutar la consulta";
    die();
}

$num_resultados = $result->num_rows;

echo "$num_resultados resultados.";

echo '<ul>';

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