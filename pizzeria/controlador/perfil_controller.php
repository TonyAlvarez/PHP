<?php


$error_email = false;
$error_pass_req = false;
$error_pass_repeat = false;
$error_pass_actual = false;
$error_avatar_size = false;
$error_avatar_type = false;
$error_avatar_permisos = false;

$cambio_contraseña = false;
$cambio_nombre = false;
$cambio_email = false;
$cambio_firma = false;
$cambio_avatar = false;

if (isset($_POST['enviar'])) {

    //Comprobar si el usuario quiere cambiar la contraseña, y verificar los datos introducidos
    if (!empty($_POST['pass'])) {

        $nuevo_pass = $_POST['pass'];
        $nuevo_pass_repeat = $_POST['pass_repeat'];
        $pass_actual = $_POST['current_pass'];

        //Comprobar requisitos de la nueva contraseña
        if (strlen($nuevo_pass) < 8 ||
            !preg_match("#[0-9]+#", $nuevo_pass) ||
            !preg_match("#[A-Z]+#", $nuevo_pass) ||
            !preg_match("#[a-z]+#", $nuevo_pass)
        ) {
            //La nueva contraseña no cumple los requisitos, avisar al usuario
            $error_pass_req = true;
        }

        //Si la contraseña cumple los requisitos, comprobar que coincide con el campo de repetición.
        if (!$error_pass_req && $nuevo_pass != $nuevo_pass_repeat) {
            //Las nuevas contraseñas no coinciden, avisar al usuario
            $error_pass_repeat = true;
        }

        //Si las nuevas contraseñas cumplen los requisitos y además coinciden, comprobar la contraseña actual
        //Aquí se comprueba que se haya introducido y que cumple los requisitos,
        // más adelante se comprobará que sea la correcta, para ello primero hay que conectar con la BD.
        if (!$error_pass_req && !$error_pass_repeat) {

            //Comprobar requisitos de la contraseña actual
            if (strlen($pass_actual) < 8 ||
                !preg_match("#[0-9]+#", $pass_actual) ||
                !preg_match("#[A-Z]+#", $pass_actual) ||
                !preg_match("#[a-z]+#", $pass_actual)
            ) {
                //La contraseña actual no cumple los requisitos, avisar al usuario
                $error_pass_actual = true;
            }
        }

        //Si no hay ningún error, se cambia la contraseña
        if (!$error_pass_req && !$error_pass_repeat && !$error_pass_actual) {
            //Variable que indica que hay que actualizar la contraseña en la BD
            $cambio_contraseña = true;
        }
    }

    //Comprobar si el usuario quiere cambiar el nombre, y no ha puesto el mismo que ya había
    if (!empty($_POST['nombre']) && $_SESSION['user']['nombre'] != $_POST['nombre']) {
        //Variable que indica que hay que actualizar el nombre en la BD
        $cambio_nombre = true;
    }

    //Comprobar si el usuario quiere cambiar el email, y no ha puesto el mismo que ya había
    if (!empty($_POST['email']) && $_SESSION['user']['email'] != $_POST['email']) {

        //Comprobar que el email tiene el formato correcto, en caso contrario avisar al usuario
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //Variable que indica que hay que actualizar el email en la BD
            $cambio_email = true;
        } else {
            //Error en el formato del email, avisar al usuario
            $error_email = true;
        }
    }

    //Comprobar si el usuario quiere cambiar la firma, y no ha puesto la misma que ya había
    if (!empty($_POST['firma']) && $_SESSION['user']['firma'] != $_POST['firma']) {
        //Variable que indica que hay que actualizar la firma en la BD
        $cambio_firma = true;
    }

    //Comprobar si el usuario quiere cambiar el avatar
    if (!empty($_FILES['avatar']['name'])) {

        /**
         * Comprobar que el tamaño de la imagen no supera el límite de 500KB
         *
         *
         * Si el archivo se ha bloqueado por el hidden MAX_FILE_SIZE el tamaño devolverá 0
         *
         * Si el usuario ha modificado el valor del hidden MAX_FILE_SIZE,
         * aún así se comprueba por código que el tamaño no supera el límite de 500KB
         *
         */
        if ($_FILES['avatar']['size'] > 0 && $_FILES['avatar']['size'] <= 512000) {

            /**
             * El siguiente código comprueba el MIME TYPE del archivo para comprobar que es una imagen
             *
             * Código modificado a partir de un snippet sacado de PHP.NET;
             *
             * http://php.net/manual/es/features.file-upload.php#114004
             */
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $formatosValidos = array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');

            if (array_search($fileInfo->file($_FILES['avatar']['tmp_name']), $formatosValidos, true)) {
                $dir_subida = 'avatares/';

                //Crear la carpeta de avatares si aún no está creada.
                if (!is_dir($dir_subida))
                    mkdir($dir_subida, 0777);

                $nombre_nuevo_avatar = time() . "-" . basename($_FILES['avatar']['name']);

                $url_nuevo_avatar = $dir_subida . $nombre_nuevo_avatar;

                //Comprobar que la imagen se ha subido correctamente y se ha movido a la carpeta de avatares
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $url_nuevo_avatar)) {

                    //Cambiarle los permisos a la imagen para después poder borrarla
                    chmod($url_nuevo_avatar, 0777);

                    //Variable que indica que hay que actualizar la ruta del avatar en la BD
                    $cambio_avatar = true;
                } else {
                    //Error al mover el archivo, probablemente por los permisos de la carpeta de destino
                    $error_avatar_permisos = true;
                }
            } else {
                //El formato del archivo es incorrecto, avisar al usuario.
                $error_avatar_type = true;
            }
        } else {
            //El archivo supera el límite de tamaño, avisar al usuario.
            $error_avatar_size = true;
        }
    }

    /**
     * Si finalmente hay algún cambio, conectamos con la base de datos y hacemos las consultas necesarias.
     */
    if ($cambio_contraseña || $cambio_nombre || $cambio_email || $cambio_avatar || $cambio_firma) {

        include_once "modelo/Conexion.php";

        $con = new Conexion();
        $con->conectar();

        /**
         * Si el usuario quiere cambiar la contraseña, el primer paso es comprobar que no haya puesto la misma que ya tiene.
         * Para ello conectamos a la base de datos y
         */
        if ($cambio_contraseña) {

            $result = $con->ejecutar_consulta("SELECT `password` FROM `usuario` WHERE `login` LIKE " . $_SESSION['user']['login']);

            //Comprobar que la consulta ha dado algún resultado
            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $pass_hash = $row['password'];

                //Comprobar que la contraseña actual es correcta
                if (password_verify($_POST['current_pass'], $pass_hash)) {

                    //La contraseña es correcta, se genera un hash para la nueva contraseña.

                    /**
                     * Este código evaluará el servidor para determinar el coste permitido.
                     * Se establecerá el mayor coste posible sin disminuir demasiando la velocidad
                     * del servidor. 8-10 es una buena referencia, y más es bueno si los servidores
                     * son suficientemente rápidos. El código que sigue tiene como objetivo un tramo de
                     * ≤ 50 milisegundos, que es una buena referencia para sistemas con registros interactivos.
                     *
                     * http://php.net/manual/es/function.password-hash.php
                     *
                     *
                     * Porque no usar md5hash:
                     *
                     * https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
                     */
                    $timeTarget = 0.05; // 50 milisegundos

                    $coste = 8;
                    do {
                        $coste++;
                        $inicio = microtime(true);
                        $updated_pass_hash = password_hash($nuevo_pass, PASSWORD_BCRYPT, ["cost" => $coste]);
                        $fin = microtime(true);
                    } while (($fin - $inicio) < $timeTarget);
                } else {
                    //La contraseña actual es incorrecta, avisar al usuario
                    $error_pass_actual = true;
                    $cambio_contraseña = false;
                }
            } else {
                //La consulta no ha dado resultados, se mantiene la contraseña anterior
                $cambio_contraseña = false;
            }
        }

        if ($cambio_nombre) {
            $_SESSION['user']['nombre'] = $_POST['nombre'];
            $updated_nombre = $_POST['nombre'];
        } else {
            $updated_nombre = $_SESSION['user']['nombre'];
        }

        if ($cambio_email) {
            $_SESSION['user']['email'] = $_POST['email'];
            $updated_email = $_POST['email'];
        } else {
            $updated_email = $_SESSION['user']['email'];
        }

        if ($cambio_firma) {
            $_SESSION['user']['firma'] = $_POST['firma'];
            $updated_firma = $_POST['firma'];
        } else {
            $updated_firma = $_SESSION['user']['firma'];
        }

        if ($cambio_avatar) {
            $_SESSION['user']['avatar'] = $nombre_nuevo_avatar;
            $updated_avatar = $nombre_nuevo_avatar;
        } else {
            $updated_avatar = $_SESSION['user']['avatar'];
        }

        /**
         * Comproba de nuevo que hay que hacer algún cambio en la BD,
         * porque si la contraseña actual introducita es incorrecta y era el único cambio que había que hacer, ya no será necesario hacer cambios
         */
        if ($cambio_contraseña || $cambio_nombre || $cambio_email || $cambio_avatar || $cambio_firma) {

            /**
             * Generamos la consulta, se comprueba de nuevo si se tiene que cambiar la contraseña o no
             * Los demás campos siempre se cambian, en caso de que le usuario no haya cambiado un campo, se inserta el valor almcenado en la sesión
             */
            $update_query = "UPDATE `usuario` SET" . ($cambio_contraseña ? " `password`= '$updated_pass_hash'," : "") . " `nombre`='$updated_nombre',`email`='$updated_email',`firma`='$updated_firma',`avatar`='$updated_avatar'
                  WHERE `login` = '" . $_SESSION['user']['login'] . "'";

            $con->ejecutar_consulta($update_query);
        }


    }

}

?>