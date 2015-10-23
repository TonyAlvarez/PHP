<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5</title>
</head>
<body>

<?php

if (isset($_POST['enviar']) && $_POST["search_query"] != null) {
    $query = $_POST['search_query'];
    $buscaren = $_POST['buscaren'];
    $genero = $_POST['genero'];

    echo "<br />";
    echo "Estos son los datos introducidos:";
    echo "<br />";
    echo "<ul>";
    echo "<li>Texto de búsqueda: " . $query . "</li>";
    echo "<li>Buscar en: " . $buscaren . "</li>";
    echo "<li>Genero: " . $genero . "</li>";
    echo "</ul>";

    echo "<br />";
    echo "<a href='ejercicio5.php'><button>Nueva búsqueda</button></a>";

} else {
    ?>
    <form method="POST">

        <label>Texto a buscar *:
            <input type="text" name="search_query"/>
        </label>
        <br />
        
        <?php

        if (isset($_POST['enviar']) && $_POST["search_query"] == null) {
            echo "<span style='color:red'>¡Debe introducir el texto de búsqueda!</span>";
            echo "<br />";
        }
        
        ?>

        <span>Buscar en:</span>
        <label>
            <input type="radio" name="buscaren" value="Titulos de canción"/>
            Titulos de canción
        </label>
        <label>
            <input type="radio" name="buscaren" value="Nombre del álbum"/>
            Nombre del álbum
        </label>
        <label>
            <input type="radio" name="buscaren" checked value="Ámbos campos"/>
            Ámbos campos
        </label>
        <br />

        <label>Género musical:
            <select name="genero">
                <option value="Todos">Todos</option>
                <option value="Acústica">Acústica</option>
                <option value="Banda sonora">Banda sonora</option>
                <option value="Blues">Blues</option>
                <option value="Electrónica">Electrónica</option>
                <option value="Folk">Folk</option>
                <option value="Jazz">Jazz</option>
                <option value="New Age">New Age</option>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
            </select>
        </label>

        <br />
        <input type="submit" value="Enviar" name="enviar">
    </form>
    <?php
}
?>


</body>
</html>