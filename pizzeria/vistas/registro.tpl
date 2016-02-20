{include file="vistas/header.tpl" title="Pizzería"}

<div class="container main">

    <div class="row color-1" id="formulario_registro">
        <div class="col-xs-12">

            {if $registro}
                <h1>Gracias por registrarte</h1>
            {else}
                <h1>Formulario de registro</h1>
                <form method="POST" class="form-horizontal">
                    <fieldset>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="usuario">Nombre de usuario</label>
                            <div class="col-md-5">
                                <input id="usuario" name="login" type="text" class="form-control input-md"
                                       {if $issetPost}value="{$login}" {/if}>

                                {if $loginVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {elseif $loginExiste}
                                    <span class="help-block">El nombre de usuario ya existe</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pass">Contraseña</label>
                            <div class="col-md-5">
                                <input id="pass" name="pass" type="password" class="form-control input-md">
                                {if $passVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {elseif $passRequisitos}
                                    <span class="help-block">La contraseña debe tener 1 número, una mayúscula y una minúscula</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pass_repeat">Repita la contraseña</label>
                            <div class="col-md-5">
                                <input id="pass_repeat" name="pass_repeat" type="password"
                                       class="form-control input-md">

                                {if $passRepeatVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {elseif $passNoCoincide}
                                    <span class="help-block">Las contraseñas no coinciden</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre</label>
                            <div class="col-md-5">
                                <input id="nombre" name="nombre" type="text" class="form-control input-md"
                                       {if $issetPost}value="{$nombre}" {/if}>

                                {if $nombreVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Correo electrónico</label>
                            <div class="col-md-5">
                                <input id="email" name="email" type="text" class="form-control input-md"
                                       {if $issetPost}value="{$email}" {/if}>

                                {if $emailVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {elseif $emailErrorFormato}
                                    <span class="help-block">El formato del email es incorrecto</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="firma">Firma personal</label>
                            <div class="col-md-5">
                                <input id="firma" name="firma" type="text" class="form-control input-md"
                                       {if $issetPost}value="{$firma}" {/if}>

                                {if $firmaVacio}
                                    <span class="help-block">Este campo es obligatorio</span>
                                {/if}
                            </div>
                        </div>

                        <!-- Multiple Checkboxes -->
                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="terminos">
                                        <input type="checkbox" name="terminos" id="terminos" value="true">
                                        Acepto los términos y condiciones
                                    </label>

                                    {if $terminos}
                                        <span class="help-block">No has aceptado los términos</span>
                                    {/if}
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="enviar"></label>
                            <div class="col-md-4">
                                <button id="enviar" name="enviar" class="btn btn-primary">Registrarme</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            {/if}
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
