{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestion de pizzas</h1>
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
                    <th>Ingredientes</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody>

                {foreach key=i item=pizza from=$pizzas}
                    <tr class="{if $pizza->getStock() eq 1}success{else}danger{/if}">
                        <td><img class="img-responsive avatar-mini" src="img/pizzas/{$pizza->getImagen()}"></td>
                        <td>{$pizza->getNombre()}</td>
                        <td width="40%">{$pizza->getDescripcion()}</td>
                        <td>{$pizza->getNombresIngredientes()}</td>
                        <td>{if $pizza->getStock() eq 1}Si{else}No{/if}</td>
                        <td class="centrar" width="20%">
                            <form method="POST" action="modificar-pizza.php">
                                <button type="submit" name="editar"
                                        value="{$pizza->getNombre()}" class="btn btn-info">Editar
                                </button>
                                <input type="hidden" name="idPizza" value="{$pizza->getIdPizza()}">
                            </form>
                            <form method="POST">
                                <button type="submit" name="cambiarStock"
                                        class="btn btn-{if $pizza->getStock() eq 1}danger{else}success{/if}">Stock
                                </button>
                                <input type="hidden" value="{$pizza->getIdPizza()}" name="idPizza">
                                <input type="hidden" value="{if $pizza->getStock() eq 1}0{else}1{/if}" name="stock">
                            </form>
                        </td>
                    </tr>
                {/foreach}

                <tr class="info">
                    <td class="centrar" colspan="6">
                        <a href="anadir-pizza.php">
                            <button class="btn btn-success">Añadir pizza</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
