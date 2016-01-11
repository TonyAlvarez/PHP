<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>


<h1>Encuesta</h1>

<?php

if (isset($_POST['enviar']) && isset($_POST['voto'])) {

    include_once "Conexion.php";

    $con = new Conexion();
    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM `votos` WHERE `id` = 1 LIMIT 1");

    $row = $result->fetch_assoc();

    $votos1 = $row['votos1'];
    $votos2 = $row['votos2'];

    $voto = $_POST['voto'];

    if ($voto == 1)
        $votos1++;
    else
        $votos2++;

    $con->ejecutar_consulta("UPDATE `votos` SET `votos1` = $votos1,`votos2` = $votos2 WHERE `id` = 1");

    echo "<p>Gracias por participar.</p>";

} else {
    ?>

    <form method="POST" enctype="multipart/form-data">
        <span>¿Te gustan las encuestas?:</span>
        <br/>
        <br/>
        <label>
            <input type="radio" name="voto" value="1"/>Si
        </label>
        <br/>
        <label>
            <input type="radio" name="voto" value="2"/>No
        </label>

        <br/>
        <br/>
        <input type="submit" value="Votar" name="enviar">
    </form>

    <?php

}

?>


<br/>

<a href="encuesta_resultados.php">Ver resultados</a>


</body>
</html>