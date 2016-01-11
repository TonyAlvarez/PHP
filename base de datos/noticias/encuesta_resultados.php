<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Resultados encuesta</h1>

<?php

include_once "Conexion.php";

$con = new Conexion();
$con->conectar();

$result = $con->ejecutar_consulta("SELECT * FROM `votos` WHERE `id` = 1 LIMIT 1");



//Pintamos la tabla
echo '<table>';
echo '<th>Respuesta</th>';
echo '<th>Votos</th>';
echo '<th>Porcentaje</th>';
echo '<th>Gráfico</th>';


$row = $result->fetch_assoc();

$votosSi = $row['votos1'];
$votosNo = $row['votos2'];

$totalVotos = $votosSi + $votosNo;

$porcentajeSi = round($votosSi / $totalVotos * 100, 2);
$porcentajeNo = round($votosNo / $totalVotos * 100, 2);

echo '<tr>';
echo "<td>Si</td>";
echo "<td>$votosSi</td>";
echo "<td>$porcentajeSi</td>";
echo "<td class='grafico'><div id='si' style=\"width: " . $porcentajeSi . "% \"></div></td>";
echo '</tr>';


echo '<tr>';
echo "<td>No</td>";
echo "<td>$votosNo</td>";
echo "<td>$porcentajeNo</td>";
echo "<td class='grafico'><div id='no' style=\"width: " . $porcentajeNo . "% \"></div></td>";
echo '</tr>';

echo '</table>';

echo '<br />';

echo "Votos totales: " . $totalVotos;

?>

</body>
</html>