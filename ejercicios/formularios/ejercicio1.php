<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 19/10/15
 * Time: 18:50
 */

if (isset($_POST['enviar'])) {
    $query = $_POST['search_query'];
    $buscaren = $_POST['buscaren'];
    $genero = $_POST['genero'];

    echo "Estos son los datos introducidos:";
    echo "<br />";
    echo "<ul>";
    echo "<li>Texto de búsqueda: " . $query . "</li>";
    echo "<li>Buscar en: " . $buscaren . "</li>";
    echo "<li>Genero: " . $genero . "</li>";
    echo "</ul>";

    echo "<br />";
    echo "<a href='ejercicio1.html'><button>Nueva búsqueda</button></a>";

}

?>