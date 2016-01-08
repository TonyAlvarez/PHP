
<?php

session_start();

$_SESSION["nombre"] = "pepe";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
</head>
<body>

    <h1>Manejo de sesiones</h1>

    <h2>Paso 1: se crea la variable de sesión y se almacena</h2>


    <p>Valor de la variable de sesión: <?php echo $_SESSION["nombre"]; ?></p>

    <a href="ejercicio1_b.php">Paso 2.</a>


</body>

</html>