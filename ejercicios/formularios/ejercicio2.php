<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 19/10/15
 * Time: 19:33
 */


if (isset($_POST['enviar'])) {
    $texto = $_POST['texto'];
    $radio = $_POST['radio'];
    $checkbox = $_POST['checkbox'];
    $hidden = $_POST['hidden'];
    $password = $_POST['password'];
    $select_simple = $_POST['color'];
    $select_multiple = $_POST['idioma'];
    $textarea = $_POST['textarea'];

    echo "Estos son los datos introducidos:";
    echo "<br />";
    echo "<ul>";
    echo "<li>Texto : " . $texto . "</li>";
    echo "<li>Radio: " . $radio . "</li>";
    echo "<li>Checkbox: " . $checkbox . "</li>";
    echo "<li>Hidden : " . $hidden . "</li>";
    echo "<li>Password : " . $password . "</li>";
    echo "<li>Color : " . $select_simple . "</li>";
    echo "<li>Idioma : " . $select_multiple . "</li>";
    echo "<li>Comentario : " . $textarea . "</li>";
    echo "</ul>";

    echo "<br />";
    echo "<a href='ejercicio1.html'><button>Nueva búsqueda</button></a>";

}


?>