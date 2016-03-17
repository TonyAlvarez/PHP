{include file="vistas/header.tpl"}

<div class="container">
    <div class="row" id="row-slider">
        <div class="col-md-12">
            <!-- Jssor Slider Begin -->
            <div id="slider-container">

                <div u="slides" id="slider-div">
                    <div><img u="image" src="img/img-slider/slider1.jpg"/></div>
                    <div><img u="image" src="img/img-slider/slider2.jpg"/></div>
                    <div><img u="image" src="img/img-slider/slider3.jpg"/></div>
                </div>

                <div u="navigator" class="bullets">
                    <div u="prototype"></div>
                </div>

                <span u="arrowleft" class="arrow-left"></span>
                <span u="arrowright" class="arrow-right"></span>
            </div>
            <!-- Jssor Slider End -->
        </div>
    </div>

    <div class="jumbotron">
        <div class="row mensajeHome">

            {if $logedIn}
                <h2>Bienvenido de nuevo {$sessionName}</h2>
            {else}
                <h2>Bienvenido a nuestra pizzería</h2>
            {/if}
        </div>

        <div class="row">

            {if $logedIn}
                <div class="col-md-offset-3 col-md-3">
                    <img class='img-rounded img-avatar' id="avatar-actual" src="img/avatares/{$sessionAvatar}">
                </div>
                <div class="col-md-6">
                    {if $sessionUserType eq 2}
                        <p>ADMINISTRADOR</p>
                    {/if}

                    <p>{$sessionUser}</p>
                    <p>{$horaInicioSesion}</p>
                </div>
            {else}
                <div class="col-md-12">
                    <p>Puedes ojear nuestros productos para ir abriendo boca.</p>
                    <p>Si quieres realizar un pedido primero tendrás que registrarte</p>
                </div>
            {/if}
        </div>
    </div>
</div>

{include file="vistas/footer.tpl"}
