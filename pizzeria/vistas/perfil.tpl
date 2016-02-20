{include file="vistas/header.tpl" title="Pizzería"}

<div class="container main">

    <div class="row color-1" id="formulario_registro">
        <div class="col-xs-12">

            <h1>Modificar perfil</h1>
            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>

                    <!-- Nombre de usuario -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <h4>{$sessionUser}</h4>
                        </div>
                    </div>

                    <!-- Avatar actual -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <img class='img-rounded img-avatar' id="avatar-actual" src="avatares/{$sessionAvatar}">
                        </div>
                    </div>

                    <!-- Boton Avatar -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="avatar">Cambiar avatar</label>
                        <div class="col-md-4">
                            <input id="avatar" name="avatar" class="input-file" type="file">

                            {if $errorTamanoAvatar}
                                <span class="help-block">El límite de tamaño para el avatar son 500KB.</span>
                            {elseif $errorTipoAvatar}
                                <span class="help-block">El archivo subido no es una imagen.</span>
                            {elseif $errorPermisosAvatar}
                                <span class="help-block">Error al subir el nuevo avatar al servidor.</span>
                            {elseif $avatarCambiado}
                                <span class="help-block cambio-ok">El avatar se ha cambiado satisfactoriamente.</span>
                            {/if}

                            <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
                        </div>
                    </div>

                    <!-- H1 MODIFICAR DATOS -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <h3>Modificar datos personales</h3>
                        </div>
                    </div>

                    <!-- INPUT NOMBRE-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre</label>
                        <div class="col-md-4">
                            <input id="nombre" name="nombre" type="text" class="form-control input-md"
                                   placeholder="{$sessionName}">
                            {if $nombreCambiado}
                                <span class="help-block cambio-ok">El nombre se ha cambiado satisfactoriamente.</span>
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT EMAIL-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Correo electrónico</label>
                        <div class="col-md-4">
                            <input id="email" name="email" type="text" class="form-control input-md"
                                   placeholder="{$sessionEmail}">
                            {if $emailErrorFormato}
                                <span class="help-block">El formato del email es incorrecto</span>
                            {elseif $emailCambiado}
                                <span class="help-block cambio-ok">El email se ha cambiado satisfactoriamente.</span>
                            {/if}
                        </div>
                    </div>

                    <!-- INPUT FIRMA-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firma">Firma personal</label>
                        <div class="col-md-4">
                            <input id="firma" name="firma" type="text" class="form-control input-md"
                                   placeholder="{$sessionFirma}">
                            {if $firmaCambiada}
                                <span class="help-block cambio-ok">La firma se ha cambiado satisfactoriamente.</span>
                            {/if}
                        </div>
                    </div>


                    <!-- H1 MODIFICAR CONTRASEÑA -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <h3>Modificar contraseña</h3>
                        </div>
                    </div>

                    <!-- Input contraseña actual-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="current_pass">Contraseña actual</label>
                        <div class="col-md-4">
                            <input id="current_pass" name="current_pass" type="password" class="form-control input-md"
                                   placeholder="********">
                            {if $passIncorrecto}
                                <span class="help-block">La contraseña es incorrecta</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Input nueva contraseña -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pass">Nueva contraseña</label>
                        <div class="col-md-4">
                            <input id="pass" name="pass" type="password" class="form-control input-md"
                                   placeholder="********">
                            {if $errorPassRequisitos}
                                <span class="help-block">La contraseña debe tener 1 número, una mayúscula y una minúscula</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Input repetir contraseña -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pass_repeat">Repita la nueva contraseña</label>
                        <div class="col-md-4">
                            <input id="pass_repeat" name="pass_repeat" type="password"
                                   class="form-control input-md" placeholder="********">
                            {if $passRepeat}
                                <span class="help-block">Las contraseñas no coinciden</span>
                            {elseif $passCambiado}
                                <span class="help-block cambio-ok">La contraseña se ha cambiado satisfactoriamente.</span>
                            {/if}
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="enviar"></label>
                        <div class="col-md-4">
                            <button id="enviar" name="enviar" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
