{include file="vistas/header.tpl"}

<div class="container">

    <div class="row centrar">

        {if $logedIn}
            {if $sessionUserType eq 2}
                <a href="gestion-masas.php">
                    <button class="btn btn-lg btn-info">
                        <span class="glyphicon glyphicon-list"></span> Gestionar masas
                    </button>
                </a>
            {else}
                <div class="alert alert-success">Selecciona una masa como base para crear tu pizza personalizada</div>
            {/if}
        {else}
            <div class="alert alert-danger">Debes iniciar sesión para poder realizar pedidos</div>
        {/if}
    </div>

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Masas
                <small>Aquí puedes ver nuestra selección de masas</small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    {foreach key=id item=masa from=$masas}
        {if $masa->getStock() eq 1}
            <div class="jumbotron">
                <div class="row centrar">
                    <div class="col-md-4">
                        <img class="img-responsive" src="img/masas/{$masa->getImagen()}">
                    </div>
                    <div class="col-md-8">
                        <h2>{$masa->getNombre()}</h2>
                        <h3>{$masa->getDescripcion()}</h3>
                        <p>¡Masa de {$masa->getTamano()} metros por solo {$masa->getPrecio()}€!</p>
                    </div>
                </div>
            </div>
        {/if}
    {/foreach}
</div>

{include file="vistas/footer.tpl"}
