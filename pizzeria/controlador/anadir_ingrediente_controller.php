<?php

require_once "modelo/gestionIngredientes.php";
require_once "modelo/clases/Ingrediente.php";

$errorTipoImagen = false;
$errorPermisosImagen = false;

if (isset($_POST['enviar'])) {

    //Comprobar si se quiere cambiar la imagen de la pizza
    if (!empty($_FILES['imagen']['name'])) {

        /**
         * El siguiente código comprueba el MIME TYPE del archivo para comprobar que es una imagen
         *
         * Código modificado a partir de un snippet sacado de PHP.NET;
         *
         * http://php.net/manual/es/features.file-upload.php#114004
         */
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);
        $formatosValidos = array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');

        if (array_search($fileInfo->file($_FILES['imagen']['tmp_name']), $formatosValidos, true)) {
            $dir_subida = 'img/ingredientes/';

            //Crear la carpeta de avatares si aún no está creada.
            if (!is_dir($dir_subida))
                mkdir($dir_subida, 0777);

            $nombre_nuevo_avatar = basename($_FILES['imagen']['name']);

            $url_nuevo_avatar = $dir_subida . $nombre_nuevo_avatar;

            //Comprobar que la imagen se ha subido correctamente y se ha movido a la carpeta de avatares
            if (@move_uploaded_file($_FILES['imagen']['tmp_name'], $url_nuevo_avatar)) {

                //Cambiarle los permisos a la imagen para después poder borrarla
                chmod($url_nuevo_avatar, 0777);
            } else {
                //Error al mover el archivo, probablemente por los permisos de la carpeta de destino
                $errorPermisosImagen = true;
            }
        } else {
            //El formato del archivo es incorrecto, avisar
            $errorTipoImagen = true;
        }
    }

    //Comprobar los errores y los campos necesarios
    if (!$errorTipoImagen && !$errorPermisosImagen && !empty($_FILES['imagen']['name']) && !empty($_POST['nombre']) && !empty($_POST['descripcion'])) {

        //Crear una instancia de Ingrediente y meter los datos del ingrediente que se esta modificando
        $ingrediente = new Ingrediente();
        $ingrediente->setImagen(basename($_FILES['imagen']['name']));
        $ingrediente->setNombre($_POST['nombre']);
        $ingrediente->setDescripcion($_POST['descripcion']);

        //Llamamos a los funcion insertarMasa del modelo.
        insertarIngrediente($ingrediente);
    }
}

?>