<?php

    if (mail("t.alvarezpascua@gmail.com", "Prueba", "Prueba", "Opcional"))
        echo "Va bien";
    else
        echo "No va";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email</title>
</head>
<body>

<form method="POST">

    <label>Escribe tu email:
        <input type="email" name="email"/>
    </label>
    <br />

    <label>
        Escribe tu sugerencia:
        <textarea name="mensaje"></textarea>
    </label>

    <br />
    <input type="submit" value="Enviar" name="enviar">
</form>
