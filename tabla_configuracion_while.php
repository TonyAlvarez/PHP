<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">

</head>
<body>

<?php


echo "<h1>Parametros de configuración de \$_SERVER con WHILE</h1>";

echo "<table>";

reset($_SERVER);

while ($valor = each($_SERVER)) {

    echo "<tr>";
    echo "<td>" .$valor[0]. "</td>";
    echo "<td>" .$valor[1]. "</td>";
    echo "</tr>";
}

echo "</table>";

?>

</body>
</html>

