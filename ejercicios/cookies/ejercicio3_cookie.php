<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 9/11/15
 * Time: 20:37
 */

if (isset($_POST["enviar"])) {
    setcookie("nombre", $_POST["nombre"]);

    ?>

    <a href="ejercicio3.php">Volver al formulario</a>

<?php

}