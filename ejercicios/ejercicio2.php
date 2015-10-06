<!DOCTYPE html>
<html>
<body>

<h1>Práctica 2 - Cadenas</h1>

<div class="container">

    <h2>Ejercicio 1</h2>

    <p>Realiza una página PHP en la que introduzca dos palabras en dos variables y diga si riman o no. Si coinciden las tres últimas letras tiene que decir que riman. Si coinciden sólo las dos últimas tiene que decir que riman un poco y si no, que no riman. Recuerda que las palabras rimarán independientemente de que se escriban con mayúsculas o minúsculas.
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


    <h2>Ejercicio 2</h2>

    <p>Realiza una página PHP que permita chequear si en una caja de texto se introduce una dirección de correo válida. Una dirección de correo válida debe tener presentes los caracteres ‘@’ y ‘.’ Si la dirección es válida escribe por un lado el nombre de usuario y por otro el dominio de dicha dirección.
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

</body>
</html>






















