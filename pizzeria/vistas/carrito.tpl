{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    {if $hayPedidos eq 1}
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Carrito de la compra</h1>
            </div>
        </div>
    {/if}

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-12">

            {if $pedidoConfirmado}
                <div class="centrar">
                    <h1>Tu pedidos se ha procesado correctamente</h1>

                    <!-- Añadir otra pizza o ir al carrito -->
                    <div class="col-md-12">
                        <a href="mis-pedidos.php">
                            <button class="btn btn-success btn-lg">Ver el estado de mis pedidos</button>
                        </a>
                    </div>
                </div>
            {elseif $hayPedidos}
                <table class="table table-responsive vert-align">
                    <thead>
                    <tr>
                        <th>Masa</th>
                        <th>Ingredientes</th>
                        <th>Unidades</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach key=i item=pedido from=$pedidos}
                        <tr class="info">
                            <td>{$pedido->getNombreMasa()}</td>
                            <td>{$pedido->getNombresIngredientes()}</td>
                            <td>{$pedido->getUnidades()}</td>
                            <td>{$pedido->getPrecioTotal()}€</td>
                            <td class="centrar">
                                <form method="POST">
                                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                    <input type="hidden" name="idPedido" value="{$pedido->getIdPedido()}">
                                </form>
                            </td>
                        </tr>
                    {/foreach}

                    <!-- Precio total -->
                    <tr class="success">
                        <td colspan="2"><h4>Total</h4></td>
                        <td><h4>{$unidadesTotales}</h4></td>
                        <td><h4>{$precioTotal}€</h4></td>
                        <td class="centrar">
                            <form method="POST">
                                <button type="submit" name="confirmar" class="btn btn-success">Confirmar pedido</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            {else}
                <div class="centrar">
                    <h1>Todavía no has añadido ninguna pizza al carrito</h1>

                    <!-- Añadir otra pizza o ir al carrito -->
                    <div class="col-md-12">
                        <a href="pedido.php">
                            <button class="btn btn-success btn-lg">¡Hacer un pedido ahora!</button>
                        </a>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
