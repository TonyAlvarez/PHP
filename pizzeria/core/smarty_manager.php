<?php

require 'vistas/smarty/libs/Smarty.class.php';

$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;
$smarty->force_compile = true;



?>