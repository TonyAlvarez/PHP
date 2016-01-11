<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body>

<?php

if (isset($_POST['enviar'])) {



}
?>

<div>
    <h1>Formulario de registro</h1>

    <form method="POST">
        <label for="nick">Login / Nickname *</label>
        <input type="text" name="nick" id="nick"/>

        <label for="pass">Contraseña *</label>
        <input type="password" name="pass" id="pass"/>

        <label for="pass_repeat">Repita la contraseña *</label>
        <input type="password" name="pass_repeat" id="pass_repeat"/>

        <label for="nombre">Nombre *</label>
        <input type="text" name="nombre" id="nombre"/>

        <label for="email">Correo electrónico *</label>
        <input type="email" name="email" id="email"/>

        <label for="firma">Firma personal *</label>
        <input type="email" name="firma" id="firma"/>

        <input type="checkbox" name="terminos" id="terminos" value="true">
        <label for="terminos">Acepto los términos y condiciones de uso</label>

        <input type="submit" value="Aceptar" name="enviar">
    </form>
</div>

</body>
</html>