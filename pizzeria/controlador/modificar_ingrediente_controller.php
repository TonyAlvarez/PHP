<?php

require_once "modelo/gestionIngredientes.php";
require_once "modelo/clases/Ingrediente.php";

//Si no se viene desde la página de gestión de usuarios, o no se está enviando el formulario de modificacion, redireccionar a gestión de usuarios
if (!isset($_POST['editar']) && !isset($_POST['enviar']))
    header('Location: gestion-ingredientes.php');

$errorTipoImagen = false;
$errorPermisosImagen = false;

if (isset($_POST['editar']) || isset($_POST['enviar'])) {

    $result = getIngrediente($_POST['idIngrediente']);

    //Crear instancias de Ingrediente a modificar a partir de los datos de la BD
    $datosIngrediente = $result->fetch_assoc();

    $ingrediente = new Ingrediente();
    $ingrediente->setIdIngrediente($datosIngrediente['id_ingrediente']);
    $ingrediente->setNombre($datosIngrediente['nombreIng']);
    $ingrediente->setDescripcion($datosIngrediente['descripcion']);
    $ingrediente->setImagen($datosIngrediente['imagen']);
    $ingrediente->setStock($datosIngrediente['stock']);
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

    //Si no hay ningún error, se cambian los datos de la pizza
    if (!$errorTipoImagen && !$errorPermisosImagen) {
        if (!empty($_FILES['imagen']['name']))
            $ingrediente->setImagen(basename($_FILES['imagen']['name']));

        if (!empty($_POST['nombre']))
            $ingrediente->setNombre($_POST['nombre']);

        if (!empty($_POST['descripcion']))
            $ingrediente->setDescripcion($_POST['descripcion']);

        //LLamamos a los funcion updateIngrediente del modelo.
        updateIngrediente($ingrediente);
    }

}

?>