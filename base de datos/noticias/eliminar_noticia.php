<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Eliminar noticias</h1>

<?php

include_once "Conexion.php";

$con = new Conexion();

$con->conectar();

if (isset($_POST['enviar']) && isset($_POST['eliminar'])) {

    $checks = $_POST['eliminar'];

    foreach ($checks as $check=>$value) {
        $con->ejecutar_consulta("DELETE FROM `noticias` WHERE `id` = " . $value);
    }

}

?>

<form method="POST" enctype="multipart/form-data">

    <?php

    $result = $con->ejecutar_consulta("SELECT * FROM noticias");

    $num_resultados = $result->num_rows;

    //Si hay resultados pintamos la tabla
    if ($num_resultados > 0) {

        //Si no está vacío pintamos la tabla
        echo '<table>';
        echo '<th>Título</th>';
        echo '<th>Texto</th>';
        echo '<th>Categoria</th>';
        echo '<th>Fecha</th>';
        echo '<th>Imagen</th>';
        echo '<th>Eliminar</th>';

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


            echo "<td><input type='checkbox' name='eliminar[]' value='$id'><br></td>";

            echo '</tr>';
        }


        echo '</table>';
    }

    ?>

    <br/>

    <input type="submit" value="Eliminar noticias" name="enviar">
</form>

</body>
</html>