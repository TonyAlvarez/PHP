<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        /* div container containing the form  */
        #searchContainer {
            margin: 20px;
        }

        /* Style the search input field. */
        #field {
            float: left;
            width: 300px;
            height: 27px;
            line-height: 27px;
            text-indent: 10px;
            font-family: arial, sans-serif;
            font-size: 1em;
            color: #333;
            background: #fff;
            border: solid 1px #d9d9d9;
            border-top: solid 1px #c0c0c0;
            border-right: none;
        }

        /* Style the "X" text button next to the search input field */
        #delete {
            float: left;
            width: 16px;
            height: 29px;
            line-height: 27px;
            margin-right: 15px;
            padding: 0 10px 0 10px;
            font-family: "Lucida Sans", "Lucida Sans Unicode", sans-serif;
            font-size: 22px;
            background: #fff;
            border: solid 1px #d9d9d9;
            border-top: solid 1px #c0c0c0;
            border-left: none;
        }

        /* Set default state of "X" and hide it */
        #delete #x {
            color: #A1B9ED;
            cursor: pointer;
            display: none;
        }

        /* Set the hover state of "X" */
        #delete #x:hover {
            color: #36c;
        }

        /* Syle the search button. Settings of line-height, font-size, text-indent used to hide submit value in IE */
        #submit {
            cursor: pointer;
            width: 70px;
            height: 31px;
            line-height: 0;
            font-size: 0;
            text-indent: -999px;
            color: transparent;
            background: url(search-icon.png) no-repeat #4d90fe center;
            border: 1px solid #3079ED;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
        }

        /* Style the search button hover state */
        #submit:hover {
            background: url(search-icon.png) no-repeat center #357AE8;
            border: 1px solid #2F5BB7;
        }
    </style>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            // if text input field value is not empty show the "X" button
            $("#field").keyup(function () {
                $("#x").fadeIn();
                if ($.trim($("#field").val()) == "") {
                    $("#x").fadeOut();
                }
            });
            // on click of "X", delete input field value and hide "X"
            $("#x").click(function () {
                $("#field").val("");
                $(this).hide();
            });
        });
    </script>
</head>
<body>

<div id="searchContainer">
    <form method="post">
        <input id="field" name="field" type="text" placeholder="Buscar"/>

        <div id="delete"><span id="x">x</span></div>
        <input id="submit" name="submit" type="submit" value="Search"/>
    </form>
</div>

<?php

include_once 'Auto.php';

if (isset($_POST['submit'])) {

    echo '<div style="margin-left: 50px">';

    if ($_POST['field'] == "") {
        echo '<p style="color: red;">El campo de búsqueda no puede estar vacío</p>';
    } else {

        $busqueda = $_POST['field'];

        if (!$con = new mysqli("localhost", "root", "")) {
            echo "Se ha producido un error de conexion";
            die();
        }

        $con->set_charset("UTF8");


        if (!$con->select_db("automoviles")) {
            echo "Se ha producido un error de conexion a la base de datos";
            die();
        }

        $consulta = "SELECT * FROM automoviles WHERE modelo like '%" . $busqueda . "%'";

        if (!$result = $con->query($consulta)) {
            echo "Se ha producido un error al ejecutar la consulta";
            die();
        }

        $num_resultados = $result->num_rows;

        echo "$num_resultados resultados.";
        $array_coches = array();

        echo '<ul>';

        $pos_auto = 0;

        while ($row = $result->fetch_row()) {

            $auto = new Auto();

            $auto->setId($row[0]);
            $auto->setMarca($row[1]);
            $auto->setModelo($row[2]);
            $auto->setConsumo($row[3]);
            $auto->setEmisiones($row[4]);

            $array_coches[$pos_auto] = $auto;

            $pos_auto++;

            echo "<li>" . $auto->getMarca() . " " . $auto->getModelo() . "</li>";

        }

        echo '</ul>';

    }

    echo '</div>';

}

?>

</body>
</html>