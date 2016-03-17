{include file="vistas/header.tpl" title="Pizzería"}

<div class="container centrar">

    <div class="row">
        <div class="col-xs-12">

            <h1 class="page-header">Modificando pizza: {$pizza->getNombre()}</h1>

            {if $issetEnviar}
                {if $datosCambiados}
                    <div class="alert alert-success centrar">La pizza se ha modificado satisfactoriamente</div>
                {/if}
            {/if}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>

                    <!-- Imagen actual -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <img class='img-rounded img-avatar' src="img/pizzas/{$pizza->getImagen()}">
                        </div>
                    </div>


                    <!-- CAMBIAR IMAGEN -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="avatar">Cambiar imagen</label>
                        <div class="col-md-4">
                            <input name="imagen" class="input-file" type="file">

                            {if $issetEnviar}
                                {if $errorTipoImagen}
                                    <span class="help-block">El archivo seleccionado no es una imagen</span>
                                {elseif $errorPermisosImagen}
                                    <span class="help-block">No se ha podido cargar la imagen</span>
                                {/if}
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT NOMBRE-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre</label>
                        <div class="col-md-4">
                            <input name="nombre" type="text" class="form-control input-md"
                                   placeholder="{$pizza->getNombre()}">
                        </div>
                    </div>

                    <!-- INPUT DESCRIPCION-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-4">
                            <input name="descripcion" type="text" class="form-control input-md"
                                   placeholder="{$pizza->getDescripcion()}">
                        </div>
                    </div>

                    <!-- INPUT INGREDIENTES-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ingredientes</label>
                        <div class="col-md-4">
                            <input name="ingredientes" type="text" class="form-control input-md"
                                   placeholder="{$pizza->getIdsIngredientes()}">
                            <span class="help-block">Introduce los IDs separados por comas</span>
                        </div>
                    </div>

                    <!-- Hidden con el ID de la pizza a modificar -->
                    <input type="hidden" name="idPizza" value="{$pizza->getIdPizza()}">

                    <!-- Button Enviar -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="enviar" name="enviar" class="btn btn-success">Confirmar modificación</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
