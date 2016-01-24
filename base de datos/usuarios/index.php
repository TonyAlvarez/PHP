<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'funciones.php';

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

    <div>
        <img src="<?php echo "avatares/" . $_SESSION["user"]["avatar"]; ?>" height="100" width="100">

        <p>Bienvenid@ <b><?php echo $_SESSION["user"]["nombre"] . " (" . $_SESSION["user"]["nick"] . ")"; ?></b></p>

        <p><?php echo $_SESSION["user"]["hora"]; ?></p>
    </div>
    <?php

} else {

    ?>

    <p>Bienvenido anónimo.</p>

    <a href="login.php" class="button">Iniciar sesión</a>

    <?php
}

?>


</body>
</html>