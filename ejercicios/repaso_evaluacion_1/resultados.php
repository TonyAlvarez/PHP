<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 12/11/15
 * Time: 15:23
 */

include_once "funciones.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Encuesta</title>
</head>
<body>

<?php setMenu(); ?>


<h4>Resultados de la encuesta:</h4>


<?php

pintarResultados();

echo "<br /><br /><a href='encuesta.php'>Volver a la encuesta</a>";
?>

</body>


</html>
