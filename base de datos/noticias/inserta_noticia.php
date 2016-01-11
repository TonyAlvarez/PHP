<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<h1>Inserción de nueva noticia</h1>

<?php

if (isset($_POST['enviar'])) {

    include_once "Conexion.php";

    $con = new Conexion();

    $con->conectar();

    if ($_POST["titulo"] == null || $_POST["texto"] == null) {

        ?>

        No se ha podido realizar la inserción debido a los siguiente errores:

        <ul>
            <li>Se requiere el título de la noticia</li>
            <li>Se requiere el texto de la noticia</li>
        </ul>

        <br/>
        <a href='inserta_noticia.php'>
            <button>Volver.</button>
        </a>

        <?php

    } else {

        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $categoria = $_POST["categoria"];

        $dir_subida = 'imagenes/';

        if (!is_dir($dir_subida))
            mkdir($dir_subida, 0777);

        $nombre_imagen = time() . "-" . basename($_FILES['imagen']['name']);

        $url_imagen = $dir_subida . $nombre_imagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $url_imagen))
            $imagen_subida = true;
        else
            $imagen_subida = false;

        $fecha_actual = date("d/m/Y H:i:s");

        if ($imagen_subida)
            $insert= "INSERT INTO `noticias`(`titulo`, `texto`, `categoria`, `fecha`, `imagen`) VALUES ('$titulo','$texto','$categoria','$fecha_actual','$nombre_imagen')";
        else
            $insert= "INSERT INTO `noticias`(`titulo`, `texto`, `categoria`, `fecha`) VALUES ('$titulo','$texto','$categoria','$fecha_actual')";


        $result = $con->ejecutar_consulta($insert);
        ?>

        La noticia ha sido recibida correctamente

        <ul>
            <li>Título: <?php echo $titulo; ?></li>
            <li>Texto: <?php echo $texto; ?></li>
            <li>Categoría: <?php echo $categoria; ?></li>
            <li>Imagen: <?php if ($imagen_subida) echo '<a href=\'' . $url_imagen . '\'>' . $url_imagen . "</a>"; ?></li>
        </ul>

        <br/>
        <a href='inserta_noticia.php'>
            <button>Insertar otra noticia.</button>
        </a>

        <?php
    }


} else {

    ?>

    <form method="POST" enctype="multipart/form-data">

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
            <select name="categoria">
                <option value="promociones">Promociones</option>
                <option value="ofertas">Ofertas</option>
                <option value="costas">Costas</option>
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

        <input type="submit" value="Insertar noticia" name="enviar">


    </form>

    <br/>

    NOTA: Los campos marcados con ( * ) son obligatorios.
    <?php
}
?>


</body>
</html>