{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestion de ingredientes</h1>
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
                    <th>ID</th>
                    <th>Ingrediente</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody>

                {foreach key=i item=ingrediente from=$ingredientes}
                    <tr class="{if $ingrediente->getStock() eq 1}success{else}danger{/if}">
                        <td>
                            <img class="img-responsive avatar-mini" src="img/ingredientes/{$ingrediente->getImagen()}">
                        </td>
                        <td>{$ingrediente->getIdIngrediente()}</td>
                        <td>{$ingrediente->getNombre()}</td>
                        <td>{$ingrediente->getDescripcion()}</td>
                        <td>{if $ingrediente->getStock() eq 1}Si{else}No{/if}</td>
                        <td class="centrar">
                            <form method="POST" action="modificar-ingrediente.php">
                                <button type="submit" name="editar"
                                        value="{$ingrediente->getIdIngrediente()}" class="btn btn-info">Editar
                                </button>
                                <input type="hidden" name="idIngrediente" value="{$ingrediente->getIdIngrediente()}">
                            </form>
                            <form method="POST">
                                <button type="submit" name="cambiarStock"
                                        class="btn btn-{if $ingrediente->getStock() eq 1}danger{else}success{/if}">Stock
                                </button>
                                <input type="hidden" value="{$ingrediente->getIdIngrediente()}"
                                       name="idIngrediente">
                                <input type="hidden" value="{if $ingrediente->getStock() eq 1}0{else}1{/if}"
                                       name="stock">
                            </form>
                        </td>
                    </tr>
                {/foreach}

                <tr class="info">
                    <td class="centrar" colspan="6">
                        <a href="anadir-ingrediente.php">
                            <button class="btn btn-success">Añadir ingrediente</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
