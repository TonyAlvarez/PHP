<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Cookies</title>
</head>
<body>

<form action="ejercicio3_cookie.php" method="POST">
    <label>Nombre:
        <input type="text" name="nombre" value="<?php if (isset($_COOKIE["nombre"])) echo $_COOKIE["nombre"] ?>" />
    </label>

    <br />
    <input type="submit" value="Enviar" name="enviar">
</form>


</body>

</html>