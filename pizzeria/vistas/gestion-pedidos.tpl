{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{$pagina}</h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-12">

            {if $hayPedidos}
                <table class="table table-responsive vert-align">
                    <thead>
                    <tr>
                        <th>ID</th>
                        {if $pagina eq "Gestión de pedidos"}
                            <th>Usuario</th>
                        {/if}
                        <th>Masa</th>
                        <th>Ingredientes</th>
                        <th>Unidades</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach key=i item=pedido from=$pedidos}
                        <tr class="{if $pedido->getServido() eq 1}success{else}danger{/if}">
                            <td>{$pedido->getIdPedido()}</td>
                            {if $pagina eq "Gestión de pedidos"}
                                <td>{$pedido->getLogin()}</td>
                            {/if}
                            <td>{$pedido->getNombreMasa()}</td>
                            <td>{$pedido->getNombresIngredientes()}</td>
                            <td>{$pedido->getUnidades()}</td>
                            <td>{$pedido->getFechayhora()}</td>
                            <td>{$pedido->getPrecioTotal()}€</td>
                            {if $pedido->getServido() eq 1}
                                <td colspan="2">Servido</td>
                            {else}
                                <td {if $pagina eq "Mis pedidos"}colspan="2"{/if}>Pendiente</td>
                                {if $pagina eq "Gestión de pedidos"}
                                    <td class="centrar">
                                        <form method="POST">
                                            <button type="submit" name="servir" class="btn btn-success">Servido</button>
                                            <input type="hidden" value="{$pedido->getIdPedido()}" name="idPedido">
                                            <input type="hidden" value="1" name="servido">
                                        </form>

                                    </td>
                                {/if}
                            {/if}
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            {else}
                <div class="centrar">
                    {if $pagina eq "Mis pedidos"}
                        <h2>Todavía no has hecho ningún pedido</h2>
                    {else}
                        <h2>Todavía no hay ningún pedido</h2>
                    {/if}
                </div>
            {/if}

        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
