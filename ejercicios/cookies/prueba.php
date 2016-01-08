<?php
setcookie('Fecha',date('Y-m-d H:i:s'));
setcookie('preferencias[idioma]','español');
setcookie('preferencias[fondo]','rojo');


echo $_COOKIE["Fecha"];
echo $_COOKIE[preferencias][idioma];
echo $_COOKIE[preferencias][fondo];
?>