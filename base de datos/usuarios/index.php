<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'metodos.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<?php setMenu(); ?>

<h1>Home</h1>


<?php

if (isset($_SESSION["login"]) && $_SESSION["login"]) {


    ?>

    <p>Bienvenido <?php echo $_SESSION["user"]["nick"]; ?></p>

    <?php


} else {
    ?>

    <p>Bienvenido anónimo.</p>

    <?php
}

?>




</body>
</html>