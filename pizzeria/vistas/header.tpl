<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria - {$pagina}</title>

    <!-- Viewport para móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Tema bootsrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/estilos.css" type="text/css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    {if $pagina eq "Home"}
        <!-- Slider Jssor -->
        <link href="css/slider.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
        <script type="text/javascript" src="js/jssor-config.js"></script>
    {elseif $pagina eq "Pedido"}
        <!-- JQuery pedidos -->
        <script type="text/javascript" src="js/pedido.js"></script>
    {elseif $pagina eq "Pizzas"}
        <!-- JQuery pizzas -->
        <script type="text/javascript" src="js/pedido_pizza.js"></script>
    {/if}
</head>

<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">La Pizzería</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li {if $pagina eq "Contacto"} class="active" {/if}><a href="contacto.php">Contacto</a></li>
                    <li {if $pagina eq "Pizzas"} class="active" {/if}><a href="pizzas.php">Pizzas</a></li>
                    <li {if $pagina eq "Masas"} class="active" {/if}><a href="masas.php">Masas</a></li>
                    <li {if $pagina eq "Ingredientes"} class="active" {/if}><a href="ingredientes.php">Ingredientes</a>
                    </li>

                    {if $logedIn}
                        <li {if $pagina eq "Pedido"} class="active" {/if}><a href="pedido.php">Crear pizza</a></li>
                        <li {if $pagina eq "Mis pedidos"} class="active" {/if}><a href="mis-pedidos.php">Mis pedidos</a>
                        </li>
                    {/if}
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {if $logedIn}
                        <li {if $pagina eq "Carrito"} class="active" {/if}>
                            <a href="carrito.php">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Carrito
                                {if $issetPedidos}<span class="badge">{$numPedidosPendientes}</span> {/if}
                            </a>
                        </li>
                        {if $sessionUserType eq 2}
                            <li class="dropdown {if $pagina|strstr:"Gestión" || $pagina|strstr:"Modificar" || $pagina|strstr:"Añadir"} active{/if}">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                    <span class="glyphicon glyphicon-wrench"></span> Administrar
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li {if $pagina eq "Gestión de usuarios"}class="active"{/if}>
                                        <a href="gestion-usuarios.php">Usuarios</a>
                                    </li>
                                    <li {if $pagina eq "Gestión de pedidos"}class="active"{/if}>
                                        <a href="gestion-pedidos.php">Pedidos</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li {if $pagina eq "Gestión de pizzas"}class="active"{/if}>
                                        <a href="gestion-pizzas.php">Pizzas</a>
                                    </li>
                                    <li {if $pagina eq "Gestión de masas"}class="active"{/if}>
                                        <a href="gestion-masas.php">Masas</a>
                                    </li>
                                    <li {if $pagina eq "Gestión de ingredientes"}class="active"{/if}>
                                        <a href="gestion-ingredientes.php">Ingredientes</a>
                                    </li>
                                </ul>
                            </li>
                        {/if}
                        <li {if $pagina eq "Perfil"} class="active" {/if}><a href="perfil.php"><span
                                        class="glyphicon glyphicon-user"></span> Perfil</a></li>
                        <li {if $pagina eq "Cerrar sesión"} class="active" {/if}><a href="salir.php"><span
                                        class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
                    {else}
                        <li {if $pagina eq "Login"} class="active" {/if}><a href="login.php"><span
                                        class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                        <li {if $pagina eq "Registro"} class="active" {/if}><a href="registro.php"><span
                                        class="glyphicon glyphicon-user"></span> Registrarse</a></li>
                    {/if}

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>