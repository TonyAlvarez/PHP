{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <div class="row centrar">

        {if $logedIn}
            {if $sessionUserType eq 2}
                <a href="gestion-ingredientes.php">
                    <button class="btn btn-lg btn-info">
                        <span class="glyphicon glyphicon-list"></span> Gestionar ingredientes
                    </button>
                </a>
            {else}
                <div class="alert alert-success">En la sección de pedidos puedes crear tus pizzas personalizadas</div>
            {/if}
        {else}
            <div class="alert alert-danger">Debes iniciar sesión para poder realizar pedidos</div>
        {/if}
    </div>

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingredientes
                <small>Aquí puedes ver nuestra amplia selección de ingredientes</small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">

        {foreach key=id item=ingrediente from=$ingredientes}
            {if $ingrediente->getStock() eq 1}
                <div class="col-sm-6 col-md-4 col-lg-3 ingrediente">
                    <img class="img-responsive" src="img/ingredientes/{$ingrediente->getImagen()}">
                    <h3>{$ingrediente->getNombre()}</h3>
                    <p>{$ingrediente->getDescripcion()}</p>
                </div>
            {/if}
        {/foreach}

    </div>
</div>

{include file="vistas/footer.tpl"}
