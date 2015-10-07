<!DOCTYPE html>
<html>
<body>

<h1>Práctica 2 - Cadenas</h1>

<div>

    <h2>Ejercicio 1</h2>

    <p>Realiza una página PHP en la que introduzca dos palabras en dos variables y diga si riman o no. Si coinciden las
        tres últimas letras tiene que decir que riman. Si coinciden sólo las dos últimas tiene que decir que riman un
        poco y si no, que no riman. Recuerda que las palabras rimarán independientemente de que se escriban con
        mayúsculas o minúsculas.
    </p>

    <?php

    $palabra1 = "Jamon";
    $palabra2 = "Orejon";

    echo $palabra1;

    if (strcasecmp(substr($palabra1, -3), substr($palabra2, -3)) == 0) {
        echo " rima con ";
    } elseif (strcasecmp(substr($palabra1, -2), substr($palabra2, -2)) == 0) {
        echo " rima un poco con ";
    } else {
        echo " no rima con ";
    }

    echo $palabra2;

    ?>

</div>

<div>
    <h2>Ejercicio 2</h2>

    <form method="post">
        <input type="text" name="email"/>
        <button type="submit" name="comprobarEmail">Comprobar</button>
    </form>
    <?php
    /**
     *
     * EJERCICIO 2
     *
     * Realiza una página PHP que permita chequear si en una caja de texto se introduce una dirección de correo válida.
     * Una dirección de correo válida debe tener presentes los caracteres ‘@’ y ‘.’ Si la dirección es válida escribe por
     * un lado el nombre de usuario y por otro el dominio de dicha dirección.
     *
     */
    if (isset($_POST['comprobarEmail'])) {
        $email = $_POST['email'];
        $email_array = explode("@", $email);
        if (count($email_array) != 1 && strpos($email_array[1], "."))
            echo "<p>Nombre - $email_array[0] <br/>Dominio - $email_array[1] </p>";
        else
            echo "<p>No has escrito una dirección valida.</p>";
    }
    ?>
</div>
<div>
    <h2>Ejercicio 3</h2>
    <?php
    /**
     *
     * EJERCICIO 3
     *
     * En algunas ocasiones tenemos que comprobar la validez de una cadena de caracteres para ver si contiene solamente
     * aquellos que consideramos como válidos. Por ejemplo, si tuviéramos que validar el nombre de usuario anterior,
     * podríamos permitir números, letras y ocasionalmente caracteres ‘-‘ o ‘_’, pero no otro tipo de caracteres como ‘+’, ‘@’, ‘&’, etc.
     * Además, siendo un nombre de usuario, podemos tener fijados un máximo y mínimo número de caracteres. Realiza una comprobación
     * para el nombre de usuario con dos partes, la primera para ver si la longitud de la cadena está permitida
     * (entre 3 y 20 caracteres) y la segunda para asegurar que los caracteres utilizados están entre los permitidos
     * (letras, números, guión alto, guión bajo).
     *
     */
    $nombre = "Pepe_MOtes-54";
    $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890-_";
    $permitido = true;
    if (strlen($nombre) >= 3 && strlen($nombre) <= 20) {
        for ($i = 0; $i < strlen($nombre); $i++)
            if (!strpos($permitidos, $nombre[$i])) $permitido = false;
    } else {
        $permitido = false;
    }
    if ($permitido) echo "Permitido";
    else echo "No Permitido";
    ?>
</div>
<div>
    <h2>Ejercicio 4</h2>
    <?php
    /**
     *
     * EJERCICIO 4
     *
     * Realiza una página PHP en la que se introduzca una frase en una variable. Muestra por pantalla las dos primeras
     * palabras de esa frase.
     *
     */
    $frase_a = "Pellentesque a risus quis magna egestas interdum vitae in ipsum.";
    echo "<p> La primera palabra es: <i>'" . strtok($frase_a, " ") . "'</i>, la segunda palabra es: <i>'" . strtok(" ") . "'</i>.</p>";
    ?>
</div>
<div>
    <h2>Ejercicio 5</h2>
    <?php
    /**
     *
     * EJERCICIO 5
     *
     * Realizar una página PHP en la que introduzca una frase en una variable y a continuación muestre el número de
     * letras ‘a’ en esa cadena.
     *
     * TODO A continuación muestra un array cuyas claves sean todas las letras contenidas en la frase y valor el número de
     * TODO veces que aparece esa letra.
     *
     */
    $frase_b = "La bala mata la vaca";
    $contadorLetraA = 0;
    $contadorTmpLetra = 0;
    $ultimaLetra = $frase_b[0];
    $letras = array();
    for ($b = 0; $b < strlen($frase_b); $b++) {
        if ($frase_b[$b] == "a") $contadorLetraA++;
    }
    echo "<p>'$frase_b' - muestra: $contadorLetraA</p>";
    ?>
</div>
<div>
    <h2>Ejercicio 6</h2>
    <?php
    /**
     *
     * EJERCICIO 6
     *
     * Realiza una página PHP en la que por medio de la función printf muestre un número tanto en binario como en octal.
     *
     */
    $numero = 12;
    $frase_c = "El numero es '%d', en octal es '%o' y en binario '%b'";
    printf($frase_c, $numero, $numero, $numero);
    ?>
</div>
<div>
    <h2>Ejercicio 7</h2>
    <?php
    /**
     *
     * EJERCICIO 7
     *
     * Realiza una página PHP en la que se introduzca una frase en una variable y a continuación muestre la misma frase
     * repitiendo todos sus caracteres.
     *
     */
    $frase_d = "CadenaOriginal";
    $frase_d2 = "";
    for ($d = 0; $d < strlen($frase_d); $d++) {
        $frase_d2 .= $frase_d[$d] . $frase_d[$d];
    }
    echo $frase_d2;
    ?>
</div>
</body>
</html>





















