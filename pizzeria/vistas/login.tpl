{include file="vistas/header.tpl" title="Pizzería"}

<div class="container main">

    <div class="row color-1" id="formulario_login">
        <div class="col-xs-12">
            <h1>Acceder como usuario registrado.</h1>

            <form method="POST" class="form-horizontal">
                <fieldset>

                    <!-- Input Usuario -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nick">Nombre de usuario: </label>
                        <div class="col-md-4">
                            <input class="form-control input-md" type="text" name="login"
                                   id="login" {if $issetPost}value="{$login}" {/if}>

                            {if $loginVacio}
                                <span class="help-block">No has introducido ningún nombre de usuario</span>
                            {elseif $loginNoExiste}
                                <span class="help-block">El nombre de usuario no existe</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Input Contraseña -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nick">Contraseña: </label>
                        <div class="col-md-4">
                            <input class="form-control input-md" type="password" name="pass" id="pass"/>

                            {if $passVacio}
                                <span class="help-block">No has introducido ninguna contraseña</span>
                            {elseif $passIncorrecto}
                                <span class="help-block">La contraseña es incorrecta</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Captcha -->
                    {if $mostrarCaptcha}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="captcha">Introduce el texto de la
                                imagen: </label>
                            <div class="col-md-4">

                                <img class='img-rounded' id="img-captcha" src='{$srcCaptcha}' alt='CAPTCHA code'>
                                <input class="form-control input-md" type="text" name="captcha" id="captcha"/>

                                {if $captchaVacio}
                                    <span class="help-block">No has introducido el texto de la imagen</span>
                                {elseif $captchaIncorrecto}
                                    <span class="help-block">El texto no coincide, prueba de nuevo</span>
                                {/if}
                            </div>
                        </div>
                    {/if}

                    <input type='hidden' name='intentos' value='{$intentosLogin}'/>


                    <div class="form-group">
                        <!-- Button Enviar -->
                        <label class="col-md-4 control-label" for="enviar"></label>
                        <div class="col-md-4">
                            <button type="submit" id="enviar" name="enviar" class="btn btn-primary">Entrar</button>
                        </div>
                    </div>


                </fieldset>
            </form>

        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
