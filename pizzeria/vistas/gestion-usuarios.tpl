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
            <table class="table table-responsive vert-align">
                <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Login</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Firma</th>
                    <th>Tipo</th>
                </tr>
                </thead>
                <tbody>

                {foreach key=i item=usuario from=$usuarios}
                    <tr class="{if $usuario->getTipo() eq 2}success{else}info{/if}">
                        <td><img class="img-responsive avatar-mini" src="img/avatares/{$usuario->getAvatar()}"></td>
                        <td>{$usuario->getLogin()}</td>
                        <td>{$usuario->getNombre()}</td>
                        <td>{$usuario->getEmail()}</td>
                        <td>{$usuario->getFirma()}</td>
                        <td>{if $usuario->getTipo() eq 2}Administrador{else}Normal{/if}</td>
                        <td class="centrar">
                            {if $usuario->getLogin() eq $sessionUser}
                                <a href="perfil.php">
                                    <button type="button" name="editar" class="btn btn-info">Editar</button>
                                </a>
                            {else}
                                <form method="POST" action="modificar-usuario.php">
                                    <button type="submit" name="editar" class="btn btn-info">Editar</button>
                                    <input type="hidden" name="login" value="{$usuario->getLogin()}">
                                </form>
                                <form method="POST">
                                    <button type="submit" name="cambiarTipo"
                                            class="btn btn-{if $usuario->getTipo() eq 1}success{else}danger{/if}">{if $usuario->getTipo() eq 1}Ascender{else}Relevar{/if}
                                    </button>
                                    <input type="hidden" value="{$usuario->getLogin()}" name="login">
                                    <input type="hidden" value="{if $usuario->getTipo() eq 1}2{else}1{/if}" name="tipo">
                                </form>
                                {if $usuario->getTipo() eq 1}
                                    <form method="POST">
                                        <button type="submit" name="banear" class="btn btn-danger">Banear</button>
                                        <input type="hidden" name="login" value="{$usuario->getLogin()}">
                                    </form>
                                {/if}
                            {/if}
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
