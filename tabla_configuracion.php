<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">

</head>
<body>

<h1>Parametros de configuración de $_SERVER</h1>

<?php

echo "<table>";
foreach($_SERVER as $key => $value){

    echo "<tr>";
    echo "<td>" .$key. "</td>";
    echo "<td>" .$value. "</td>";
    echo "</tr>";
}

echo "</table>";

?>
</body>
</html>

