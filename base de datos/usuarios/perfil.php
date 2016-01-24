<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'funciones.php';

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    //Si no se ha iniciado sesion, se redirecciona a HOME.
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<?php

setMenu();

if (isset($_POST['enviar'])) {

    $error_email = false;
    $error_pass_req = false;
    $error_pass_repeat = false;
    $error_pass_actual = false;
    $error_avatar_size = false;
    $error_avatar_type = false;

    $cambio_contraseña = false;
    $cambio_nombre = false;
    $cambio_email = false;
    $cambio_firma = false;
    $cambio_avatar = false;

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
    if (!empty($_FILES['imagen']['name'])) {

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
        if ($_FILES['imagen']['size'] > 0 && $_FILES['imagen']['size'] <= 512000) {

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
                $dir_subida = 'avatares/';

                //Crear la carpeta de avatares si aún no está creada.
                if (!is_dir($dir_subida))
                    mkdir($dir_subida, 0777);

                $nombre_nuevo_avatar = time() . "-" . basename($_FILES['imagen']['name']);

                $url_nuevo_avatar = $dir_subida . $nombre_nuevo_avatar;

                //Comprobar que la imagen se ha subido correctamente y se ha movido a la carpeta de avatares
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $url_nuevo_avatar)) {
                    //Cambiarle los permisos a la imagen para después poder borrarla
                    chmod($url_nuevo_avatar, 0777);

                    //Variable que indica que hay que actualizar la ruta del avatar en la BD
                    $cambio_avatar = true;
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

        include_once "Conexion.php";

        $con = new Conexion();
        $con->conectar();

        /**
         * Si el usuario quiere cambiar la contraseña, el primer paso es comprobar que no haya puesto la misma que ya tiene.
         * Para ello conectamos a la base de datos y
         */
        if ($cambio_contraseña) {

            $result = $con->ejecutar_consulta("SELECT `password` FROM `usuarios` WHERE `id` LIKE " . $_SESSION['user']['id']);

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
            $update_query = "UPDATE `usuarios` SET" . ($cambio_contraseña ? " `password`= '$updated_pass_hash'," : "") . " `nombre`='$updated_nombre',`email`='$updated_email',`firma`='$updated_firma',`avatar`='$updated_avatar'
                  WHERE `id` = " . $_SESSION['user']['id'];

            $con->ejecutar_consulta($update_query);
        }


    }

}

?>


<h1>Editar Perfil</h1>

<div id="contenedor-form">

    <form method="POST" id="registro" enctype="multipart/form-data">

        <label for="nick">Usuario:</label>
        <p class="nick"><?php echo $_SESSION['user']['nick'] ?></p>

        <label for="tipo">Rango de usuario:</label>
        <p class="tipo"><?php echo $_SESSION['user']['tipo'] ?></p>


        <h3>Cambiar avatar</h3>

        <div class="avatar">
            <img src="<?php echo "avatares/" . $_SESSION["user"]["avatar"]; ?>" height="100" width="100">
        </div>

        <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>

        <input type="file" name="imagen">
        <span class="tipo">* El límite de tamaño para el avatar son 500KB.</span>

        <?php

        if (isset($_POST['enviar'])) {
            if ($error_avatar_size) {
                echo "<span style='color:red'>El tamaño de la imagen no puede superar los 500KB.</span>";
            } else if ($error_avatar_type) {
                echo "<span style='color:red'>El archivo subido no es una imagen.</span>";
            } else if ($cambio_avatar) {
                echo "<span style='color:green'>El avatar se ha cambiado satisfactoriamente.</span>";
            }
        }

        ?>


        <h3>Cambiar datos personales</h3>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="<?php echo $_SESSION['user']['nombre']; ?>"/>

        <?php
        if (isset($_POST['enviar']) && $cambio_nombre) {
            echo "<span style='color:green'>El nombre se ha cambiado satisfactoriamente.</span>";
        }
        ?>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" placeholder="<?php echo $_SESSION['user']['email']; ?>"/>

        <?php
        if (isset($_POST['enviar'])) {
            if ($error_email) {
                echo "<span style='color:red'>El formato del email no es correcto</span>";
            } else if ($cambio_email) {
                echo "<span style='color:green'>El email se ha cambiado satisfactoriamente.</span>";
            }
        }
        ?>

        <label for=" firma">Firma personal:</label>
        <input type="text" name="firma" id="firma" placeholder="<?php echo $_SESSION['user']['firma']; ?>"/>

        <?php
        if (isset($_POST['enviar']) && $cambio_firma) {
            echo "<span style='color:green'>La firma se ha cambiado satisfactoriamente.</span>";
        }
        ?>


        <h3>Cambiar contraseña</h3>

        <label for="current_pass">Contraseña actual:</label>
        <input type="password" name="current_pass" id="current_pass" placeholder="********"/>

        <?php
        if (isset($_POST['enviar'])) {
            if ($error_pass_actual) {
                echo "<span style='color:red'>La contraseña es incorrecta</span>";
            }
        }
        ?>

        <label for="pass">Nueva contraseña:</label>
        <input type="password" name="pass" id="pass" placeholder="********"/>

        <?php

        if (isset($_POST['enviar'])) {
            if ($error_pass_req) {
                echo "<span style='color:red'>La contraseña tiene que tener al menos 8 caracteres, incluyendo al menos una letra minúscula, una mayúscula y un número</span>";
            }
        }
        ?>

        <label for="pass_repeat">Repita la nueva contraseña:</label>
        <input type="password" name="pass_repeat" id="pass_repeat" placeholder="********"/>

        <?php
        if (isset($_POST['enviar'])) {
            if ($error_pass_repeat) {
                echo "<span style='color:red'>Las contraseñas no coinciden</span>";
            } else if ($cambio_contraseña) {
                echo "<span style='color:green'>La contraseña se ha cambiado satisfactoriamente.</span>";
            }
        }
        ?>

        <input type="submit" value="Confirmar" name="enviar">
    </form>

</div>

</body>
</html>