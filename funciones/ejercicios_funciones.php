<?php

include_once('calculos.php');

echo "<h1>Ejercicio 1</h1>";

/**
 * Realiza una función que pueda recibir tres parámetros: el nombre de un país, la capital (si no recibe capital tomará el valor Madrid) y el número de habitantes (si no recibe este valor mostrará “muchos”) y llámala para mostrar una frase con esos valores del tipo:

La capital de España es Madrid y tiene muchos habitantes.
La capital de Portugal es Lisboa y tiene muchos habitantes.
La capital de Francia es Paris y tiene 6.000.000 habitantes.
Llámala con diferente número de argumentos para comprobar que toma correctamente los valores por defecto.
 */


echo frasesCiudades("España");
echo frasesCiudades("Portugal", "Lisboa");
echo frasesCiudades("Francia", "Paris", 6000000);


echo "<h1>Ejercicio 2</h1>";

/**
 * Realiza una función que reciba como parámetro un número entero (el número de días ) y devuelva el número de segundos de esos días.
 */

$dias = 20;

echo "$dias dias son " . diasASegundos($dias) . " segundos";


echo "<h1>Ejercicio 3</h1>";

/**
 * Realiza una función que reciba como parámetro el título de la página y escriba el encabezado html, el head y el títle de la misma.
 */

echo crearHTML("Titulo de prueba");


echo "<h1>Ejercicio 4</h1>";

/**
 * Realiza una función que reciba como parámetro un texto y lo devuelva escrito en negrita.
 */


$frase = "Hola caracola";

echo "Frase normal: " . $frase;
echo "<br />";
echo "Frase negrita: " . convertirNegrita($frase);




echo "<h1>Ejercicio 5</h1>";

/**
 *

Crea un fichero llamado “calculos.php”, en el cual realices dos funciones para calcular e imprimir por pantalla los gastos de una determinada compra. Las dos funciones tendrán las siguientes características:
“Gastos_por_valor” a la cual se le pasarán 4 parámetros (categoría, unidades, urgente e importe).
“Gastos_por_referencia” contendrá los mismos parámetros que la anterior, pero devolverá el cálculo del importe total por referencia en lugar de por valor.

Datos a tener en cuenta:

El valor por defecto de la variable urgente deberá estar a FALSE.
Existen 4 categorías, que sirven para discernir el recargo a aplicar en función de la misma (Ejemplo: Categoría 1 → precio = 10, Categoría 2 → precio = 20). Por defecto, el precio es 0 si no pertenecen a ninguna categoría de las 4 indicadas.
El importe será: (precio + iva) * unidades.
Si se indica que es un pedido urgente, se le deberá sumar un 5% al precio total.

Generar un archivo “programa.php” en el que se llame a ambas funciones e imprima por pantalla el valor de los cuatro parámetros así como el precio total obtenido tras los cálculos.

 *
 *
 */

echo "Comprando 1 unidades de categoria 2 con envio urgente<br />";

$importe = 0;

echo "Calculo importe por valor: " . gastosPorValor(2,1,0,true);
echo "<br />";
gastosPorReferencia(2,1,$importe,true);
print "Calculo importe por referencia: " . $importe;



?>