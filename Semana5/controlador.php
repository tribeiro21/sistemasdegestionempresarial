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
            
            if($fila["Key"] == NULL && $fila["Field"] != "epoch"){
            echo'
                <div class="campo">
                    
                    <p>'.$fila["Comment"].'</p>
                    ';
                    if($fila["Null"] == "NO"){echo "<p>* Campo obligatorio</p>";}
                    echo '
                    <input type="';
                    if($fila["Field"] == 'email'){
                        echo "email";
                    }
                    else if(strpos($fila["Type"],"varchar") !== false){
                        echo "text";
                    }
                    else if(strpos($fila["Type"],"int") !== false){
                        echo "number";
                    }
                    echo '"name="'.$fila["Field"].'" id="'.$fila["Field"].'"';
                    if($fila["Null"] == "NO"){echo "required";}
                    if($fila["Field"] == "epoch"){echo "disabled";}
                    preg_match('#\((.*?)\)#',$fila["Type"], $match);
                    echo'
                    maxlength = "'.$match[1].'"
                    placeholder = "'.$fila["Field"].'"
                    >
                </div>
            ';
            }
        }
    echo '<input type="submit">';        
    $mysqli->close();
    }
    function procesaformulario(){
        //echo "procesando formulario";
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