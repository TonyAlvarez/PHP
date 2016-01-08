
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

<h2>Paso 3: la variable ya ha sido destruida y su valor se ha perdido.</h2>

<p>Valor de la variable de sesión: <?php echo @$_SESSION["nombre"]; ?></p>


<a href="ejercicio1_a.php">Volver al paso 1.</a>


</body>

</html>


<?php
session_destroy();
setcookie("nombre");
?>