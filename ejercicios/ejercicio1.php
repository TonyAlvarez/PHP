<!DOCTYPE html>
<html>
<body>

<h1>Práctica 1 - Arrays</h1>

<div class="container">
    <h2>Ejercicio 1</h2>

    <p>Crea un array $dias con los días de la semana y muestra todas sus parejas índices/valores mediante un bucle foreach y for.</p>

    <?php

    $d = array(
        1 => "Lunes",
        2 => "Martes",
        3 => "Miercoles",
        4 => "Jueves",
        5 => "Viernes",
        6 => "Sabado",
        7 => "Domingo"
    );

    for($i = 1; $i <= 7; $i++){
        echo "<p>Hoy es $d[$i], y tiene el indice $i.</p>";
    }

    ?>
    <h2>Ejercicio 2</h2>

    <p>Crea un array con una lista de 5 alumnos de la clase. Muestra primero la lista de los 3 primeros alumnos del array y luego los dos últimos de la lista usando las funciones array_slice y array_splice.</p>


    <ol>
        <?php

        $a = array("Alex","Toni","Ignaci","Ivan","Karen");

        $s1 = array_slice($a,0,3);
        $s2 = array_splice($a, -2,2);

        $length1 = count($s1);
        for ($i = 0; $i < $length1; $i++) {
            print "<li>$s1[$i]</li>";
        }
        $length2 = count($s2);
        for ($i = 0; $i < $length2; $i++) {
            print "<li>$s2[$i]</li>";
        }

        ?>
    </ol>

    <h2>Ejercicio 3</h2>

    <p>Crea un array de dos dimensiones, de manera que en una dimensión contenga el tipo de colores (fuerte o suave) y en la otra 3 colores de cada tipo. Muestra una tabla como la siguiente recorriendo el array :</p>

    <?php

    $c = array();
    $c[0][0] = "Rojo:FF0000";
    $c[0][1] = "Verde:00FF00";
    $c[0][2] = "Azul:0000FF";
    $c[1][0] = "Rosa:FE9ABC";
    $c[1][1] = "Amarillo:FDF189";
    $c[1][2] = "Malva:BC8F8F";

    ?>
    <table style="border: 1px solid #000; border-collapse: collapse;">
        <?php
        for ($i = 0; $i < 2; $i++){
            if ($i == 0){
                print "<tr><td style='border: 1px solid #000; padding: 15px;'>Colores Fuertes:</td>";
            } else {
                print "</tr><tr><td style='border: 1px solid #000; padding: 15px;'>Colores Flojos:</td>";
            }
            for($x = 0; $x < 3; $x++){
                $fondo = split(":", $c[$i][$x]);
                print "<td style='border: 1px solid #000; padding: 15px;background-color:#".$fondo[1]."'>". $c[$i][$x] ."</td>";
            }
        }
        ?>
        </tr>
    </table>




    <h2>Ejercicio 4</h2>


    <p>Dado el array anterior comprueba si en él se encuentra el color “FF88CC” y el color “FF0000” usando la función in_array.</p>

        <?php


        $c = array();
        $c[1]['rojo'] = "Rojo:FF0000";
        $c[1]['verde'] = "Verde:00FF00";
        $c[1]['azul'] = "Azul: 0000FF";
        $c[2]['rosa'] = "Rosa:FE9ABC";
        $c[2]['amarillo'] = "Amarillo:FDF189";
        $c[2]['malva'] = "Malva:BC8F8F";

        ?>





    <h2>Ejercicio 5</h2>

    <p>Crea un array llamado pila como éste:
        </br>
        $pila = array(“cinco” => 5, “uno”=>1, “cuatro”=>4, “dos”=>2, “tres”=>3);
        </br>
        Muestra el array ordenado por asort, arsort, ksort, sort, rsort.</p>

    <?php

    $pila = array(
        "cinco" => 5,
        "uno"=>1,
        "cuatro"=>4,
        "dos"=>2,
        "tres"=>3);


    echo "<h3>ASORT:</h3>";

    asort($pila);

    foreach($pila as $key=>$value){
        echo "<p>$key = $value</p>";
    }

    echo "<h3>ARSORT:</h3>";

    arsort($pila);

    foreach($pila as $key=>$value){
        echo "<p>$key = $value</p>";
    }

    echo "<h3>KSORT:</h3>";

    ksort($pila);

    foreach($pila as $key=>$value){
        echo "<p>$key = $value</p>";
    }

    echo "<h3>SORT:</h3>";

    sort($pila);

    foreach($pila as $key=>$value){
        echo "<p>$key = $value</p>";
    }

    echo "<h3>RSORT:</h3>";

    rsort($pila);

    foreach($pila as $key=>$value){
        echo "<p>$key = $value</p>";
    }



    ?>



    <h2>Ejercicio 6</h2>

    <p>Crea un array con los países de la Unión Europea y sus capitales.
        </br>Muestra por cada uno de ellos la frase: “La capital de 'país' es 'capital'”.
        </br>Luego ordena la lista por el nombre del país y luego por el nombre de la capital.</p>

    <?php

    $capital = array(
        "España" => "Madrid",
        "Francia" => "Paris",
        "Austria" => "Viena",
        "Bélgica" => "Bruselas",
        "Bulgaria" => "Sofía",
        "Chipre" => "Nicosia",
        "Croacia" => "Zagreb",
        "República Checa" => "Praga",
        "Italia" => "Roma",
        "Lituania" => "Vilna",
        "Letonia" => "Riga",
        "Luxemburgo" => "Luxemburgo",
        "Malta" => "La Valeta",
        "Países Bajos" => "Ámsterdam",
        "Dinamarca" => "Copenhague",
        "Polonia" => "Varsovia",
        "Estonia" => "Tallin",
        "Portugal" => "Lisboa",
        "Finlandia" => "Helsinki",
        "Rumanía" => "Bucarest",
        "Eslovaquia" => "Bratislava",
        "Alemania" => "Berlin",
        "Eslovenia" => "Liubliana",
        "Grecia" => "Atenas",
        "Hungría" => "Budapest",
        "Suecia" => "Estocolmo",
        "Irlanda" => "Dublín",
        "Reino Unido" => "Londres");

    foreach($capital as $key=>$value){
        echo "<p>La capital de $key es $value</p>";
    }

    echo "<h3>Ordenadas por el nombre del pais:</h3>";

    ksort($capital);

    foreach($capital as $key=>$value){
        echo "<p>La capital de $key es $value</p>";
    }


    asort($capital);

    echo "<h3>Ordenadas por el nombre de la capital:</h3>";


    foreach($capital as $key=>$value){
        echo "<p>La capital de $key es $value</p>";
    }

    ?>


    <h2>Ejercicio 7</h2>

    <p>Obtén el número de valores iguales al valor 2 contenidos en un array de 10 valores generados aleatoriamente con valores de 1 a 10.</p>

    <?php

    $aleatorios = array(
        1 => rand(1, 10),
        2 => rand(1, 10),
        3 => rand(1, 10),
        4 => rand(1, 10),
        5 => rand(1, 10),
        6 => rand(1, 10),
        7 => rand(1, 10),
        8 => rand(1, 10),
        9 => rand(1, 10),
        10 => rand(1, 10));

    $coincidencias = 0;

    for($i = 1; $i <= 10; $i++){
        if ($aleatorios[$i] == 2) {
            $coincidencias++;
        }
    }


    for($i = 1; $i <= 10; $i++){
        if ($aleatorios[$i] == 2) {
            echo "<p><b>Valor $i = $aleatorios[$i].</b></p>";
        } else {
            echo "<p>Valor $i = $aleatorios[$i].</p>";
        }
    }

    echo "El número 2 ha aparicido $coincidencias veces";
    ?>

</div>

</body>
</html>






















