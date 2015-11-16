
<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
</head>
<body>


<h1>Manejo de sesiones</h1>

<h2>Paso 2: se accede a la variable de sesión almacenada y se destruye.</h2>

<p>Valor de la variable de sesión: <?php echo $_SESSION["nombre"]; ?></p>


<a href="ejercicio1_c.php">Paso 3.</a>


</body>

</html>


<?php
unset($_SESSION["nombre"]);

?>
