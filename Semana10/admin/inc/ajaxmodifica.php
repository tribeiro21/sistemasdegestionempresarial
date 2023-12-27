<?php

    include "../../config.php";
    $mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
    $consulta = "UPDATE ".$_GET['tabla']." SET ".$_GET['columna']."='".$_GET['valor']."' WHERE Identificador = ".$_GET['identificador']."";
    $resultado = $mysqli->query($consulta);

?>