{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestion de masas</h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive vert-align">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tamaño</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody>

                {foreach key=i item=masa from=$masas}
                    <tr class="{if $masa->getStock() eq 1}success{else}danger{/if}">
                        <td><img class="img-responsive avatar-mini" src="img/masas/{$masa->getImagen()}"></td>
                        <td>{$masa->getNombre()}</td>
                        <td width="40%">{$masa->getDescripcion()}</td>
                        <td>{$masa->getTamano()} metros</td>
                        <td>{$masa->getPrecio()}€</td>
                        <td>{if $masa->getStock() eq 1}Si{else}No{/if}</td>
                        <td class="centrar" width="20%">
                            <form method="POST" action="modificar-masa.php">
                                <button type="submit" name="editar"
                                        value="{$masa->getId()}" class="btn btn-info">Editar
                                </button>
                                <input type="hidden" name="idMasa" value="{$masa->getId()}">
                            </form>
                            <form method="POST">
                                <button type="submit" name="cambiarStock"
                                        class="btn btn-{if $masa->getStock() eq 1}danger{else}success{/if}">Stock
                                </button>
                                <input type="hidden" value="{$masa->getId()}"
                                       name="idMasa">
                                <input type="hidden" value="{if $masa->getStock() eq 1}0{else}1{/if}"
                                       name="stock">
                            </form>
                        </td>
                    </tr>
                {/foreach}

                <tr class="info">
                    <td class="centrar" colspan="7">
                        <a href="anadir-masa.php">
                            <button class="btn btn-success">Añadir masa</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
