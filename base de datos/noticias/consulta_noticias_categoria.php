<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Consulta de noticias por categoria</h1>


<form method="POST" enctype="multipart/form-data">

    <label>Mostrar resultado de la categoría:
        <select name="categoria">
            <option value="todas">Todas</option>
            <option value="costas">Costas</option>
            <option value="ofertas">Ofertas</option>
            <option value="promociones">Promociones</option>
        </select>
    </label>

    <input type="submit" value="Mostrar" name="enviar">

</form>

<?php


if (isset($_POST['enviar']) && isset($_POST["categoria"])) {

    include_once "Conexion.php";

    $con = new Conexion();
    $con->conectar();


    //Obtenemos la categoria del POST
    if ($_POST["categoria"] == "todas")
        $result = $con->ejecutar_consulta("SELECT * FROM noticias");
    else
        $result = $con->ejecutar_consulta("SELECT * FROM noticias WHERE `categoria` LIKE '" . $_POST["categoria"] . "'");

    $num_resultados = $result->num_rows;

    //Mostramos el número total de resultados.
    echo $num_resultados . " resultados. <br />";

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
}

?>

</body>
</html>