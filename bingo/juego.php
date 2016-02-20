<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Bingo!</title>
    <link rel="stylesheet" href="estilos.css">

</head>

<body>

<div id="contenedor">

    <?php

    include_once "funciones_bingo.php";


    if (isset($_POST['sacarBola'])) {
        //Al pulsar el botón, sacamos una bola
        sacarBola();
    } else {
        //(Re)Iniciamos el Bingo, con el número de cartones que queremos
        iniciarBingo(4);
    }

    ?>

</div>

</body>
</html>