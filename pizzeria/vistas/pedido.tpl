{include file="vistas/header.tpl"}

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-xs-12">

            {if $issetPost}
                <div class="centrar">
                    <h1>Tu pizza se ha añadido al carrito</h1>

                    <!-- Añadir otra pizza o ir al carrito -->
                    <div class="col-md-12">
                        <div class="btn-group">
                            <a href="pedido.php">
                                <button class="btn btn-success btn-lg">¡Quiero otra pizza!</button>
                            </a>
                            <a href="carrito.php">
                                <button class="btn btn-danger btn-lg">Finalizar compra</button>
                            </a>
                        </div>
                    </div>
                </div>
            {else}
                <div class="centrar">
                    <h1>Realizar pedido</h1>


                    <div class="alert alert-success">Elige tu masa favorita y añade tantos ingredientes como quieras
                        <br/>
                        Cada ingredientes añadido suma 1€ al precio de la pizza
                    </div>
                </div>
                <form class="form-horizontal" method="POST">
                    <fieldset>

                        <div id="masas">

                            <!-- Titulo -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="page-header">1 - Elige una masa</h2>
                                </div>
                            </div>

                            <!-- Masas -->
                            <div class="row centrar">
                                {foreach key=id item=masa from=$masas}
                                    {if $masa->getStock() eq 1}
                                        <div class="col-md-2 masa">
                                            <img class="img-responsive" src="img/masas/{$masa->getImagen()}">
                                            <h4>{$masa->getNombre()}</h4>
                                            <p>{$masa->getPrecio()}€</p>
                                            <input type="hidden" name="precioMasa" value="{$masa->getPrecio()}">
                                            <input type="radio" name="masa" value="{$masa->getId()}" class="hidden">
                                        </div>
                                    {/if}
                                {/foreach}
                            </div>

                        </div>
                        <div id="ingredientes" class="hidden">

                            <!-- Titulo -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="page-header">2 - Elige los ingredientes</h2>
                                </div>
                            </div>

                            <!-- Ingredientes -->
                            <div class="row centrar ingredientes" style="margin: 40px 0">
                                {foreach key=id item=ingrediente from=$ingredientes}
                                    {if $ingrediente->getStock() eq 1}
                                        <div class="col-sm-4 col-md-3 col-lg-2 ingrediente">
                                            <img class="img-responsive"
                                                 src="img/ingredientes/{$ingrediente->getImagen()}">
                                            <h4>{$ingrediente->getNombre()}</h4>
                                            <input value="{$ingrediente->getIdIngrediente()}" name="ingrediente[]"
                                                   type="checkbox"
                                                   class="hidden">
                                        </div>
                                    {/if}
                                {/foreach}
                            </div>

                        </div>

                        <div id="div_cantidad" class="hidden">

                            <!-- Titulo -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="page-header">3 - Elige la cantidad</h2>
                                </div>
                            </div>

                            <!-- Numero de pizzas -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="cantidad">¿Cuantas pizzas quieres?</label>
                                <div class="col-md-4">
                                    <input id="cantidad" min="0" name="cantidad" type="number"
                                           class="form-control input-md">
                                </div>
                            </div>

                        </div>

                        <div id="div_enviar" class="hidden">

                            <!-- Titulo -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="page-header">4 - Añade tu pizza al carrito</h2>
                                </div>
                            </div>

                            <!-- Button confirmar -->
                            <div class="form-group centrar">
                                <div class="col-md-12">
                                    <h3 id="precio_pizza"></h3>
                                    <button id="enviar" name="enviar" class="btn btn-success btn-lg">Añadir al carrito
                                    </button>
                                </div>
                            </div>

                        </div>

                    </fieldset>
                </form>
            {/if}

        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
