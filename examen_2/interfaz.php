<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 26/11/15
 * Time: 16:57
 */


function setCabecera()
{
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Examen Primera evaluación</title>
    </head>
    <body>

    <h1>Examen Primera evaluación</h1>

    <a href="home.php">Home</a> -*- <a href="guestbook.php">Libro de visitas</a> -*- <a href="guestbook_encuesta.php">Encuesta</a> -*- <a href="estadisticas.php">Estadísticas</a>
<?php

}


function piePagina()
{

    echo '
<p>Gracias por tu visita. © Todos los derechos reservados</p>
</body>
</html>';
}