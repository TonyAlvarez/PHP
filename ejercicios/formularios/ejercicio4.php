<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
</head>
<body>

<?php

if (isset($_POST['enviar'])) {

    ?>

    <h1>Subida de ficheros. Resultados del formulario</h1>

    <h2>Resultado de la inserción de nueva noticia</h2>


    <?php

    if ($_POST["titulo"] == null || $_POST["texto"] == null) {

        ?>

        No se ha podido realizar la inserción debido a los siguiente errores:

        <ul>
            <li>Se requiere el título de la noticia</li>
            <li>Se requiere el texto de la noticia</li>
        </ul>

        <br/>
        <a href='ejercicio4.php'>
            <button>Volver</button>
        </a>

        <?php

    } else {

        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $opcion = $_POST["opcion"];

        $dir_subida = 'img/';

        if (!is_dir($dir_subida))
            mkdir($dir_subida, 0777);

        $url_imagen = $dir_subida . time() . "-" . basename($_FILES['imagen']['name']);

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $url_imagen))
            $imagen_subida = true;
        else
            $imagen_subida = false;
        ?>

        La noticia ha sido recibida correctamente

        <ul>
            <li>Título: <?php echo $titulo; ?></li>
            <li>Texto: <?php echo $texto; ?></li>
            <li>Categoría: <?php echo $opcion; ?></li>
            <li>Imagen: <?php if ($imagen_subida) echo "<a href='" . $url_imagen . "'>" . $url_imagen . "</a>"; ?></li>
        </ul>

        <br/>
        <a href='ejercicio4.php'>
            <button>Insertar otra noticia</button>
        </a>

        <?php
    }


} else {

    ?>


    <h1>Subida de ficheros.</h1>

    <h2>Insertar nueva noticia</h2>

    <form style="border:1px solid blue; padding: 10px" method="POST" enctype="multipart/form-data">

        <label>Título: *
            <input type="text" name="titulo">
        </label>

        <br/>
        <br/>

        <label>Texto: *
            <textarea name="texto"></textarea>
        </label>

        <br/>
        <br/>

        <label>Categoría:
            <select name="opcion">
                <option value="Opción 1">Opción 1</option>
                <option value="Opción 2">Opción 2</option>
                <option value="Opción 3">Opción 3</option>
            </select>
        </label>

        <br/>
        <br/>


        <input type="hidden" name="MAX_FILE_SIZE" value="500000"/>

        <label>Imagen:
            <input type="file" name="imagen">
        </label>

        <br/>
        <br/>

        <input type="submit" value="Subir noticia" name="enviar">


    </form>

    <br/>

    NOTA: Los campos marcados con ( * ) son obligatorios.
    <?php
}
?>


</body>
</html>