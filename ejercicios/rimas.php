<!DOCTYPE html>
<html>
<body>

<h1>Ejercicio rimas</h1>

<div class="container">



    <p>Crea una función que le pases dos strings y comprueba si las palabras riman.</p>

    <?php

    $palabra1 = "jamon";
    $palabra2 = "orejon";

    if (strcasecmp(substr($palabra1, -3), substr($palabra2, -3))) {
        echo "Riman";
    } elseif (strcasecmp(substr($palabra1, -2), substr($palabra2, -2))) {
        echo "Riman un poco";
    } else {
      echo "No riman";
    }

    ?>

</div>

</body>
</html>






















