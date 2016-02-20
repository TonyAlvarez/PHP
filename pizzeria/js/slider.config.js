$(document).ready(function ($) {
    var _SlideshowTransitions = [{
        $Duration: 1000,
        $Delay: 80,
        $Cols: 10,
        $Rows: 4,
        $Clip: 15,
        $SlideOut: true,
        $Easing: $JssorEasing$.$EaseOutQuad
    }, {
        $Duration: 1500,
        x: 0.2,
        y: -0.1,
        $Delay: 80,
        $Cols: 10,
        $Rows: 4,
        $Clip: 15,
        $During: {$Left: [0.2, 0.8], $Top: [0.2, 0.8]},
        $ChessMode: {$Column: 15, $Row: 15},
        $Easing: {$Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseLinear},
        $Round: {$Left: 0.8, $Top: 2.5}
    }, {
        $Duration: 1000,
        $Delay: 30,
        $Cols: 10,
        $Rows: 4,
        $Clip: 15,
        $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
        $Assembly: 2050,
        $Easing: $JssorEasing$.$EaseInQuad
    }];
    var options = {
        $AutoPlay: true,
        $AutoPlayInterval: 3000,
        $Transitions: _SlideshowTransitions,
        $FillMode: 1,
        $SlideshowOptions: {$Class: $JssorSlideshowRunner$, $Transitions: _SlideshowTransitions, $TransitionsOrder: 1,},
        $BulletNavigatorOptions: {$Class: $JssorBulletNavigator$, $ChanceToShow: 1, $AutoCenter: 1, $SpacingX: 0,},
        $ArrowNavigatorOptions: {$Class: $JssorArrowNavigator$, $ChanceToShow: 1, $AutoCenter: 2,}
    };

    var jssor_slider1 = new $JssorSlider$('slider-container', options);

    function ScaleSlider() {
        var parentWidth = $('#slider-container-portada').parent().width();
        if (parentWidth) {
            jssor_slider1.$ScaleWidth(parentWidth);
        } else
            window.setTimeout(ScaleSlider, 30);
    }

    ScaleSlider();
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
});