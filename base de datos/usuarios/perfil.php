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
    <title>Perfil</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<?php setMenu(); ?>

<h1>Perfil</h1>

<p>Work in progress..</p>


</body>

</html>
