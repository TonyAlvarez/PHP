<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Consulta de noticias con paginado</h1>

<?php

include_once "Conexion.php";

$con = new Conexion();
$con->conectar();

/*
 * Ejecutamos un select * para saber el total de resultados y hacer la páginacion si es necesario.
 */
$result = $con->ejecutar_consulta("SELECT * FROM noticias");

$num_resultados = $result->num_rows;
$TAMANO_PAGINACION = 3;

//Mostramos el número total de resultados.
echo $num_resultados. " resultados. <br />";

/*
 * Si el total de páginas es mayor al tamaño de paginación, se hace la paginación,
 * sino se muestran todos los resultados en una misma página
 */
if ($num_resultados > $TAMANO_PAGINACION) {


    //Obtenemos el número de página que hay que mostrar del GET
    if (isset($_GET["pagina"]))
        $pagina = $_GET["pagina"];
    else
        //Si no hay GET se muestra la página 1.
        $pagina = 1;

    //El número del primer resultado que se mostrará
    $inicio = ($pagina - 1) * $TAMANO_PAGINACION;

    //Cambiamos la variable $result, por una query que limita el numero de resultados, y empieza por el primer número que queremos mostrar
    $result = $con->ejecutar_consulta("SELECT * FROM noticias LIMIT " . $inicio . "," . $TAMANO_PAGINACION);
    $num_resultados_pagina = $result->num_rows;

    //El número del último resultado que se mostraará
    $fin = $inicio + $num_resultados_pagina;

    //Número total de páginas
    $total_paginas = ceil($num_resultados / $TAMANO_PAGINACION);

    //Información de la paginación.
    echo "Mostrando resultados del " . ($inicio + 1) . " al " . $fin . "<br />";
    echo "Página " . $pagina . " de " . $total_paginas . "<br />";

    //URL para usar en la paginacion
    $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"];

    //Enlace a la página anterior
    if ($pagina != 1)
        echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><--</a>';

    //Pintar todos los números de página, con enlace si es necesario
    for ($i = 1; $i <= $total_paginas; $i++) {
        if ($pagina == $i)
            echo $pagina;
        else
            echo '  <a href="' . $url . '?pagina=' . $i . '">' . $i . '</a>  ';
    }

    //Enlace a la página siguiente
    if ($pagina != $total_paginas)
        echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '">--></a>';

}

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