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
        <title>Salir</title>
        <link rel="stylesheet" type="text/css" href="estilos.css"/>
    </head>
    <body>

    <?php setMenu(); ?>

    <h1>Salir</h1>

    <p>Se ha cerrado la sesión.</p>

    <p>Redireccionando a la página de inicio ...</p>

    </body>

    </html>

<?php

header( "refresh:2; url=index.php" );
destruirSesion();

?>