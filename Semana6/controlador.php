<?php
class Supercontrolador {
    
    function formulario($tabla){
        include "config.php";
        echo '<form action="?" method="POST">';
        echo '<input type="hidden" name="clave" value="procesaformulario">';
        echo '<input type="hidden" name="tabla" value="'.$tabla.'">';
        $mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
        $consulta = "SHOW FULL COLUMNS FROM ".$tabla;
        $resultado = $mysqli->query($consulta);
        while ($fila = $resultado->fetch_assoc()) {
            
            if(json_decode($fila["Comment"])->visible == "true"){
                preg_match('#\((.*?)\)#',$fila["Type"], $match);
            echo'
                <div class="campo">
                    <h3>'.json_decode($fila["Comment"])->titulo.'</h3>
                    <p>'.json_decode($fila["Comment"])->descripcion.' - Caracteres mínimo '.json_decode($fila["Comment"])->min.' maximo '.$match[1].'<p>
                    ';
                    if($fila["Null"] == "NO"){echo "<p>* Campo obligatorio</p>";}
                    
                    echo '
                    <div class="contienecampo">
                    <table><tr><td width="80%">
                    <input type="'.json_decode($fila["Comment"])->tipodato.'" name="'.$fila["Field"].'" id="'.$fila["Field"].'"
                    ';
                    if($fila["Null"] == "NO"){echo "required";}
                    if(json_decode($fila["Comment"])->deshabilitado == "true"){echo " disabled ";}
                    preg_match('#\((.*?)\)#',$fila["Type"], $match);
                    echo'
                    maxlength = "'.$match[1].'"
                    minlength = "'.json_decode($fila["Comment"])->min.'"
                    placeholder = "'.json_decode($fila["Comment"])->placeholder.'"
                    >
                    </td><td width="20%">
                    <div class="tipocampo"><i class="'.json_decode($fila["Comment"])->icono.'"></i></div>
                    </td></tr></table>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
            ';
            }
        }
    echo '<input type="submit">';        
    $mysqli->close();
    }
    function procesaformulario(){
        // Vamos analizar que es lo que viene antes de meterlo
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
        $listadocolumnas = "";
        $listadovalores = "";
        foreach($_POST as $nombre_campo => $valor){
            //echo "recibo el campo ".$nombre_campo." con el valor ".$valor."<br>";
            if($nombre_campo != 'tabla' && $nombre_campo != 'clave'){
                $listadocolumnas .= ",".$nombre_campo."";
                $listadovalores .= ",'".$valor."'";
            }
        }
        
        $mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
        $consulta = "INSERT INTO ".$_POST['tabla']." (Identificador".$listadocolumnas.") VALUES (NULL".$listadovalores.")";
        //echo $consulta;
        
        
        $mysqli->query($consulta);
        echo '
            <div class="advice">
                <h1>Tu entrega se ha registrado</h1>
                <p>Serás redirigido en 2 segundos</p>
            </div>
        ';
        echo '<meta http-equiv="Refresh" content="2; url=?" />
        ';
        
    }
}
?>
</form>