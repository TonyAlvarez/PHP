$(document).ready(function () {

    //Cachear los elementos del formulario
    var masa = $('.masa');

    var divIngredientes = $('#ingredientes');
    var ingredientes = $('.ingrediente');

    var divCantidad = $('#div_cantidad');
    var cantidad = $('#cantidad');

    var divEnviar = $('#div_enviar');
    var enviar = $('#enviar');

    //Ocultar los ingredientes, la cantidad y el boton confirmar
    divIngredientes.removeClass("hidden");
    divCantidad.removeClass("hidden");
    divEnviar.removeClass("hidden");

    divIngredientes.slideUp(0);
    divCantidad.slideUp(0);
    divEnviar.slideUp(0);

    //Deshabilitar el boton de enviar formulario
    enviar.prop('disabled', true);

    //Variables para calcular el precio del pedido
    var precioMasa = 0;
    var numIngredientes = 0;

    /**
     * Cuando se elija la masa, mostrar los ingredientes
     */
    masa.click(function () {

        precioMasa = $(this).find('input:hidden').val();

        $(this).find('input:radio').prop('checked', true);

        masa.each(function () {
            if ($(this).find('input:radio').prop('checked')) {
                $(this).addClass('seleccionado');
            } else {
                $(this).removeClass('seleccionado');
            }
        });

        divIngredientes.slideDown(500);

        //Hacer scroll a los ingredientes
        setTimeout(function () {
            $('html, body').animate({
                scrollTop: $(document).height()
            }, 250);
        }, 250);

        $('#precio_pizza').text("Precio: " + (parseFloat(precioMasa) + numIngredientes) * cantidad.val() + "€");
    });

    /**
     * Al elegir un ingrediente, mostrar el input de cantidad
     */
    ingredientes.click(function () {

        if (!$(this).find('input:checkbox').prop('checked')) {
            $(this).addClass('seleccionado');
            $(this).find('input:checkbox').prop('checked', true);
        } else {
            $(this).removeClass('seleccionado');
            $(this).find('input:checkbox').prop('checked', false);
        }

        if (ingredientes.find('input:checked').length == 1) {
            divCantidad.slideDown(250);

            //Hacer scroll a la cantidad
            setTimeout(function () {
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 250);
            }, 250);
        } else if (ingredientes.find('input:checked').length == 0) {

            //Ocultar input de cantidad y boton de confirmar
            divCantidad.slideUp(250);
            divEnviar.slideUp(250);
        }

        numIngredientes = $(document).find('input:checkbox:checked').length;

        $('#precio_pizza').text("Precio: " + (parseFloat(precioMasa) + numIngredientes) * cantidad.val() + "€");
    });

    cantidad.change(function () {
        if ($(this).val() > 0) {
            //Habilitar y mostrar boton de confirmar
            enviar.prop('disabled', false);
            divEnviar.slideDown(250);

            //Hacer scroll a confirmar pedido
            setTimeout(function () {
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 250);
            }, 250);


            $('#precio_pizza').text("Precio: " + (parseFloat(precioMasa) + numIngredientes) * cantidad.val() + "€");
        } else {
            //Ocultar boton de confirmar y deshabilitar el boton de enviar formulario
            divEnviar.slideUp(250);
            enviar.prop('disabled', true);
        }
    });

    cantidad.keyup(function () {
        if ($(this).val() > 0) {
            //Habilitar y mostrar boton de confirmar
            enviar.prop('disabled', false);
            divEnviar.slideDown(250);

            //Hacer scroll a confirmar pedido
            setTimeout(function () {
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 250);
            }, 250);

            $('#precio_pizza').text("Precio: " + (parseFloat(precioMasa) + numIngredientes) * cantidad.val() + "€");
        } else {
            //Ocultar boton de confirmar y deshabilitar el boton de enviar formulario
            divEnviar.slideUp(250);
            enviar.prop('disabled', true);
        }
    });

});