<?php

require_once "modelo/gestionMasas.php";
require_once "modelo/clases/Masa.php";

//Si no se viene desde la página de gestión de usuarios, o no se está enviando el formulario de modificacion, redireccionar a gestión de usuarios
if (!isset($_POST['editar']) && !isset($_POST['enviar']))
    header('Location: gestion-masas.php');

$errorTipoImagen = false;
$errorPermisosImagen = false;

if (isset($_POST['editar']) || isset($_POST['enviar'])) {

    $result = getMasa($_POST['idMasa']);

    //Crear instancias de Masa a modificar a partir de los datos de la BD
    $datosMasa = $result->fetch_assoc();

    $masa = new Masa();
    $masa->setId($datosMasa['id_masa']);
    $masa->setNombre($datosMasa['nombre']);
    $masa->setDescripcion($datosMasa['descripcion']);
    $masa->setPrecio($datosMasa['precio']);
    $masa->setTamano($datosMasa['tamano']);
    $masa->setImagen($datosMasa['imagen']);
    $masa->setStock($datosMasa['stock']);
}

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
            $dir_subida = 'img/masas/';

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

    //Si no hay ningún error, se cambian los datos de la pizza
    if (!$errorTipoImagen && !$errorPermisosImagen) {
        if (!empty($_FILES['imagen']['name']))
            $masa->setImagen(basename($_FILES['imagen']['name']));

        if (!empty($_POST['nombre']))
            $masa->setNombre($_POST['nombre']);

        if (!empty($_POST['descripcion']))
            $masa->setDescripcion($_POST['descripcion']);

        if (!empty($_POST['tamano']))
            $masa->setTamano($_POST['tamano']);

        if (!empty($_POST['precio']))
            $masa->setPrecio($_POST['precio']);

        //LLamamos a los funcion updateMasa del modelo.
        updateMasa($masa);
    }

}

?>