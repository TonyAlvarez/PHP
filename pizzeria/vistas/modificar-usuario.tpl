{include file="vistas/header.tpl" title="Pizzería"}

<div class="container centrar">

    <div class="row">
        <div class="col-xs-12">

            <h1 class="page-header">Modificando usuario: {$usuario->getLogin()}</h1>

            {if $issetEnviar}
                {if $datosCambiados}
                    <div class="alert alert-success centrar">Los datos se han modificado satisfactoriamente</div>
                {/if}
            {/if}

            <!-- Avatar actual -->
            <div class="col-md-offset-4 col-md-4">
                <img class='img-rounded img-avatar' id="avatar-actual" src="img/avatares/{$usuario->getAvatar()}">
            </div>

            {if $usuario->getAvatar() neq "avatar_defecto.jpg"}
                <!-- Boton Restablecer Avatar -->
                <div class="col-md-offset-4 col-md-4">
                    <form method="POST">
                        <button type="submit" name="restablecerAvatar" class="btn btn-success">Reestablecer avatar
                        </button>
                        <input type="hidden" name="login" value="{$usuario->getLogin()}">
                    </form>
                </div>
            {/if}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <form method="POST" class="form-horizontal">
                <fieldset>

                    <!-- H1 MODIFICAR DATOS -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <h3>Modificar datos personales</h3>
                        </div>
                    </div>

                    <!-- INPUT NOMBRE-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre</label>
                        <div class="col-md-4">
                            <input id="nombre" name="nombre" type="text" class="form-control input-md"
                                   placeholder="{$usuario->getNombre()}">
                        </div>
                    </div>

                    <!-- INPUT EMAIL-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Correo electrónico</label>
                        <div class="col-md-4">
                            <input id="email" name="email" type="text" class="form-control input-md"
                                   placeholder="{$usuario->getEmail()}">
                            {if $issetEnviar && $emailErrorFormato}
                                <span class="help-block">El formato del email es incorrecto</span>
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT FIRMA-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Firma personal</label>
                        <div class="col-md-4">
                            <input id="firma" name="firma" type="text" class="form-control input-md"
                                   placeholder="{$usuario->getFirma()}">
                        </div>
                    </div>


                    <!-- H1 MODIFICAR CONTRASEÑA -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <h3>Modificar contraseña</h3>
                        </div>
                    </div>

                    <!-- Input nueva contraseña -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nueva contraseña</label>
                        <div class="col-md-4">
                            <input id="pass" name="pass" type="password" class="form-control input-md"
                                   placeholder="********">
                            {if $issetEnviar && $errorPassRequisitos}
                                <span class="help-block">La contraseña debe tener 1 número, una mayúscula y una minúscula</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Input repetir contraseña -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Repita la nueva contraseña</label>
                        <div class="col-md-4">
                            <input id="pass_repeat" name="pass_repeat" type="password"
                                   class="form-control input-md" placeholder="********">
                            {if $issetEnviar && $passRepeat}
                                <span class="help-block">Las contraseñas no coinciden</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Hidden con el login del usuario a modificar -->
                    <input type="hidden" name="login" value="{$usuario->getLogin()}">

                    <!-- Button -->
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
