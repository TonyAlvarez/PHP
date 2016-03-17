$(document).ready(function () {

    var modalActivo;

    //Variables para calcular el precio de la pizza
    var precioMasa = 0;
    var numIngredientes = 0;

    $('.modal').on('shown.bs.modal', function () {
        modalActivo = $(this);
        numIngredientes = $(this).find($('input:hidden[name=num_ingredientes]')).val();

        $(this).find('.div-cantidad').slideUp(0);

        //Ocultar los ingredientes y la cantidad
        $(this).find('.div-cantidad').prop('disabled', true);

        //Deshabilitar el boton de enviar formulario
        $(this).find('.enviar').prop('disabled', true);

        $(this).find('.masa').click(function () {

            precioMasa = $(this).find('input:hidden').val();

            $(this).find('input:radio').prop('checked', true);

            modalActivo.find('.masa').each(function () {
                if ($(this).find('input:radio').prop('checked')) {
                    $(this).addClass('seleccionado');
                } else {
                    $(this).removeClass('seleccionado');
                }
            });

            modalActivo.find('.div-cantidad').removeClass("hidden");
            modalActivo.find('.div-cantidad').slideDown();

            modalActivo.find('.div-precio h4').text("Precio: " + (parseFloat(precioMasa) + parseFloat(numIngredientes)) * parseFloat($('#cantidad_' + modalActivo.attr('id')).val()) + "€");

        });

        $('#cantidad_' + modalActivo.attr('id')).change(function () {
            if ($(this).val() > 0) {
                //Habilitar y mostrar boton de confirmar
                modalActivo.find('.enviar').prop('disabled', false);
                modalActivo.find('.div-precio').removeClass("hidden");
                modalActivo.find('.div-precio').slideDown();
                modalActivo.find('.div-precio h4').text("Precio: " + (parseFloat(precioMasa) + parseFloat(numIngredientes)) * parseFloat($('#cantidad_' + modalActivo.attr('id')).val()) + "€");

            } else {
                //Ocultar boton de confirmar y deshabilitar el boton de enviar formulario
                modalActivo.find('.enviar').prop('disabled', true);
            }
        });

        $('#cantidad_' + modalActivo.attr('id')).keyup(function () {
            if ($(this).val() > 0) {
                //Habilitar y mostrar boton de confirmar
                modalActivo.find('.enviar').prop('disabled', false);
                modalActivo.find('.div-precio').removeClass("hidden");
                modalActivo.find('.div-precio').slideDown();
                modalActivo.find('.div-precio h4').text("Precio: " + (parseFloat(precioMasa) + parseFloat(numIngredientes)) * parseFloat($('#cantidad_' + modalActivo.attr('id')).val()) + "€");

            } else {
                //Ocultar boton de confirmar y deshabilitar el boton de enviar formulario
                modalActivo.find('.enviar').prop('disabled', true);
            }
        });
    });

    $('.modal').on('hidden.bs.modal', function () {
        //Modal cerrado
        $(this).find('input:radio').prop('checked', false);
        $(this).find('.masa').removeClass('seleccionado');

        $('#cantidad_' + modalActivo.attr('id')).val("");
        $(this).find('.div-cantidad').slideUp(0);

        $(this).find('.div-cantidad').addClass("hidden");
    });

});