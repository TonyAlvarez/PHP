{include file="vistas/header.tpl"}

<div class="container">

    {if $issetPost}
        <div class="centrar">
            <h1>Tu pizza se ha añadido al carrito</h1>

            <!-- Añadir otra pizza o ir al carrito -->
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="pizzas.php">
                        <button class="btn btn-success btn-lg">¡Quiero otra pizza!</button>
                    </a>
                    <a href="carrito.php">
                        <button class="btn btn-danger btn-lg">Finalizar compra</button>
                    </a>
                </div>
            </div>
        </div>
    {else}
        <div class="row centrar">

            {if $logedIn}
                {if $sessionUserType eq 2}
                    <a href="gestion-pizzas.php">
                        <button class="btn btn-lg btn-info">
                            <span class="glyphicon glyphicon-list"></span> Gestionar pizzas
                        </button>
                    </a>
                {else}
                    <div class="alert alert-success">Si no te convence ninguna de estas pizzas, en la sección de pedidos
                        puedes crear tus pizzas personalizadas
                    </div>
                {/if}
            {else}
                <div class="alert alert-danger">Debes iniciar sesión para poder realizar pedidos</div>
            {/if}
        </div>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pizzas
                    <small>Aquí puedes ver nuestra selección de pizzas de la casa</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row centrar">
            {foreach key=id item=pizza from=$pizzas}
                {if $pizza->getStock() eq 1}
                    <div class="col-md-6 pizza">
                        <div class="col-md-4">
                            <img class="img-responsive" src="img/pizzas/{$pizza->getImagen()}">
                        </div>
                        <div class="col-md-8">
                            <h3>{$pizza->getNombre()}</h3>
                            <h4>{$pizza->getDescripcion()}</h4>
                            {if $logedIn}

                                <!-- Button pedir -->
                                <button id="{$pizza->getIdPizza()}" type="button" class="btn btn-success pedir"
                                        data-toggle="modal"
                                        data-target="#model_pizza_{$pizza->getIdPizza()}">
                                    ¡Pedir!
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="model_pizza_{$pizza->getIdPizza()}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form id="form_pizza_{$pizza->getIdPizza()}" method="POST">

                                                    <div class="row centrar">

                                                        <h3 class="modal-title">Pizza {$pizza->getNombre()}</h3>

                                                        <div class="col-md-12">
                                                            <div class="col-md-4">
                                                                <img class="img-responsive"
                                                                     src="img/pizzas/{$pizza->getImagen()}">
                                                            </div>

                                                            <!-- Nombre Ingredientes -->
                                                            <div class="col-md-8">
                                                                <h4>Ingredientes</h4>
                                                                <input name="cantidad" type="text"
                                                                       class="form-control input-md"
                                                                       value="{$pizza->getNombresIngredientes()}"
                                                                       disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h4>¿Que masa quieres?</h4>

                                                            <!-- Masas -->
                                                            {foreach key=id item=masa from=$masas}
                                                                {if $masa->getStock() eq 1}
                                                                    <div class="col-md-4 masa">
                                                                        <img class="img-responsive"
                                                                             src="img/masas/{$masa->getImagen()}">
                                                                        <h4>{$masa->getNombre()}</h4>
                                                                        <p>{$masa->getPrecio()}€</p>
                                                                        <input type="hidden" name="precio_masa"
                                                                               value="{$masa->getPrecio()}">
                                                                        <input type="radio" name="masa"
                                                                               value="{$masa->getId()}"
                                                                               class="hidden">
                                                                    </div>
                                                                {/if}
                                                            {/foreach}

                                                        </div>

                                                        <!-- IDS Ingredientes Hidden -->
                                                        <input name="ingredientes" type="hidden"
                                                               class="form-control input-md"
                                                               value="{$pizza->getIdsIngredientes()}">

                                                        <!-- NUM Ingredientes Hidden -->
                                                        <input type="hidden" name="num_ingredientes"
                                                               value="{$pizza->getNumIngredientes()}">

                                                        <!-- Numero de pizzas -->
                                                        <div class="col-md-12 div-cantidad hidden">
                                                            <h4>¿Cuantas pizzas quieres?</h4>

                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input id="cantidad_model_pizza_{$pizza->getIdPizza()}"
                                                                           type="number" min="1" name="cantidad"
                                                                           class="form-control input-md input-cantidad">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Precio pizza -->
                                                        <div class="col-md-12 div-precio hidden">
                                                            <h4 class="precio_pizza">Precio</h4>
                                                        </div>

                                                        <div class="modal-footer centrar">
                                                            <button type="reset" class="btn btn-danger"
                                                                    data-dismiss="modal">Cancelar
                                                            </button>
                                                            <button name="enviar" type="submit"
                                                                    class="btn btn-success enviar">Añadir al carrito
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                {/if}
            {/foreach}
        </div>
    {/if}
</div>

{include file="vistas/footer.tpl"}
