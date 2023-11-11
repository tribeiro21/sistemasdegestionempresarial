<?php

    foreach($_REQUEST as $nombre_campo => $valor){
            //echo "el campo es: ".$nombre_campo." y el valor es ".$valor;
            if(preg_match('~\b(delete|drop|truncate)\b~i',$nombre_campo)){
                $volcado = implode(",", $_REQUEST).",".$_SERVER['REMOTE_ADDR'].",".$_SERVER['HTTP_USER_AGENT']."\n";
                $myfile = fopen("volcado.txt", "a");
                fwrite($myfile, $volcado);
                die("ejecucion detenida");
            }
            if(preg_match('~\b(delete|drop|truncate)\b~i',$valor)){
                $volcado = implode(",", $_REQUEST).",".$_SERVER['REMOTE_ADDR'].",".$_SERVER['HTTP_USER_AGENT']."\n";
                $myfile = fopen("volcado.txt", "a");
                fwrite($myfile, $volcado);
                die("ejecucion detenida");
            }
        }

    include "config.php";
    $mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

    $cadena = "";
    foreach($_REQUEST as $nombre_campo => $valor){$cadena .=$nombre_campo.":".$valor."|";}

    $consulta = "INSERT INTO registros VALUES (NULL,'".date('U')."','".$url."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$cadena."')";
    $mysqli->query($consulta);
?>

