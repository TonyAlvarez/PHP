<?php

include_once 'interfaz.php';

setMenu();

?>

<h2>Libro de visitas</h2>

<form method="post">

    <label>¿Te ha gustado la página?
        <br/>
        <br/>
        <input type="radio" name="encuesta" checked value="si"> Si
        <br/>
        <input type="radio" name="encuesta" value="no"> No
        <br/>
        <br/>
    </label>

    <label>Tu comentario:
        <br/>
        <textarea name="comentario"></textarea>
    </label>
    <br/>

    <?php
    //Comprobar el comentario, sino mostrar un erroren rojo
    if (isset($_POST['publicar']) && $_POST["comentario"] == null)
        echo "<p style='color:red'>¡No has escrito ningún comentario!</p>";
    ?>

    <label>Tu nombre:
        <br/>
        <input type="text" name="nombre"/>
    </label>
    <br/>

    <?php
    //Comprobar el nombre, sino mostrar un erroren rojo
    if (isset($_POST['publicar']) && $_POST["nombre"] == null)
        echo "<p style='color:red'>¡El nombre es obligatorio!</p>";
    ?>

    <label>Tu e-mail:
        <br/>
        <input type="email" name="email"/>
    </label>
    <br/>

    <?php
    //Comprobar el email, sino mostrar un erroren rojo
    if (isset($_POST['publicar']) && $_POST["email"] == null)
        echo "<p style='color:red'>¡El email es obligatorio!</p>";
    ?>

    <br/>
    <button type="submit" name="publicar">Publicar comentario</button>
    <br/>

</form>

<?php

//Las rutas de los distintos archivos
$rutaComentarios = './comentarios.txt';
$rutaEncuesta = './encuesta.txt';

//Comprobamos que todos los campos tengan datos
if (isset($_POST['publicar']) && $_POST['comentario'] != null && $_POST['nombre'] != null && $_POST['email'] != null) {

    //Abrimos el fichero de encuestas
    $ficheroEncuesta = fopen($rutaEncuesta, 'a+') or die('Error al guardar la encuesta');

    //Escribimos la seleccion del usuario y cerramos el archivo
    fwrite($ficheroEncuesta, $_POST['encuesta'] . "\n");
    fclose($ficheroEncuesta);

    //Abrimos el fichero de comentarios
    $fichero = fopen($rutaComentarios, 'a+') or die('Error al guardar el comentario');

    //Creamos un objetvo con la fecha actual
    $fechaActual = new DateTime();

    //Separamos en fecha y hora
    $fecha = $fechaActual->format("Y-m-d");
    $hora = $fechaActual->format("H-i-s");

    //Si no existe el fichero metemos solo el comentario, si ya existe metemos un separador al principio
    if (file_exists($rutaComentarios) && filesize($rutaComentarios) == 0)
        fwrite($fichero, $_POST['nombre'] . '*' . $_POST['email'] . '*' . $fecha . '*' . $hora . '*' . $_POST['comentario']);
    else
        fwrite($fichero, '|' . $_POST['nombre'] . '*' . $_POST['email'] . '*' . $fecha . '*' . $hora . '*' . $_POST['comentario']);

    //Cerramos el fichero
    fclose($fichero);

    //Tdo ha ido bien, mostramos el mensaje
    echo '<p>Muchas gracias por insertar su comentario. ¡Vuelva pronto!</p>';
}

?>
    <br/>

<a href="estadisticas.php">Estadísticas de los visitantes.</a>

    <br/>
    <br/>
<hr/>

<h3>Comentarios de los visitantes</h3>

<?php

//Leer fichero de comentarios
if (file_exists($rutaComentarios)) {
    //Leemos tdo el fichero de golpe
    $contenido = file_get_contents($rutaComentarios);

    //Lo separamos por comentarios
    $comentarios = explode('|', $contenido);

    //Imprimir los comentarios en orden cronológico
    for ($i = count($comentarios) - 1; $i >= 0; $i--) {

        //Separamos el comentario en los distintos campos, transformando la \n en <br> para que se conserven los saltos de linea
        $comentario = explode('*', nl2br($comentarios[$i]));

        //Imprimimos el comentario
        echo '<div style="border: 1px solid blue; padding: 10px; margin-top: 10px">';
        echo '<b>' . $comentario[0] . '</b> (<a href="mailto:' . $comentario[1] . '">' . $comentario[1] . '</a>) ' . ' escrito el ' . $comentario[2] . ' a las ' . $comentario[3] . ';';
        echo '<p>' . $comentario[4] . '</p>';
        echo '</div>';
    }
} else {
    //Si el fichero no existe ponemos el mensaje
    echo 'Sea el primero en darnos su opinión.';
}
piePagina();
?>