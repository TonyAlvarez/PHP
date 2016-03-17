{include file="vistas/header.tpl" title="Pizzería"}

<div class="container centrar">

    <div class="row">
        <div class="col-xs-12">

            <h1 class="page-header">Añadir masa</h1>

            {if $issetEnviar}
                {if $datosCambiados}
                    <div class="alert alert-success centrar">La masa se ha modificado satisfactoriamente</div>
                {/if}
            {/if}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>


                    <!-- SUBIR IMAGEN -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="avatar">Imagen de la masa</label>
                        <div class="col-md-4">
                            <input name="imagen" class="input-file" type="file">

                            {if $issetEnviar}
                                {if $imagenVacia}
                                    <span class="help-block">La imagen es obligatoria</span>
                                {elseif $errorTipoImagen}
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
                            <input name="nombre" type="text" class="form-control input-md">

                            {if $issetEnviar}
                                {if $nombreVacio}
                                    <span class="help-block">El nombre es obligatorio</span>
                                {/if}
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT DESCRIPCION-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-4">
                            <input name="descripcion" type="text" class="form-control input-md">
                            {if $issetEnviar}
                                {if $descripcionVacia}
                                    <span class="help-block">La descripción es obligatoria</span>
                                {/if}
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT TAMAÑO-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tamaño</label>
                        <div class="col-md-4">
                            <input name="tamano" type="number" step="any" class="form-control input-md">
                            {if $issetEnviar}
                                {if $tamanoVacio}
                                    <span class="help-block">El tamaño es obligatorio</span>
                                {/if}
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT PRECIO-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Precio</label>
                        <div class="col-md-4">
                            <input name="precio" type="number" step="any" class="form-control input-md">
                            {if $issetEnviar}
                                {if $precioVacio}
                                    <span class="help-block">El precio es obligatorio</span>
                                {/if}
                            {/if}
                        </div>
                    </div>

                    <!-- Button Enviar -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="enviar" name="enviar" class="btn btn-success">Añadir masa</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}