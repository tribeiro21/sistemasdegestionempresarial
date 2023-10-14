<html>
<style>
    body{font-family:sans-serif;}
    form{background:grey;color:aquamarine;}
    .campo{margin-bottom:30px;border-bottom:2px solid red;}
    .campo label{font-size:4em;padding:0px;margin:0px;}
    .campo p{font-size:2em;padding:0px;margin:0px;}
    head{background:white;}
    h1{color:red;}
    
</style>
<body>
<header>
    <h1>Entrega de actividades</h1>
</header>
<form action="?" method="POST">
<?php
$mysqli = new mysqli("localhost", "supercrud", "supercrud", "supercrud");

/* verificar la conexión */
if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}

$tabla = "entregas";

// Luego quiero ver las columnas
$consulta = "SHOW FULL COLUMNS FROM ".$tabla;
$resultado = $mysqli->query($consulta);
while ($fila = $resultado->fetch_assoc()) {
    /*
        echo "La columna se llama: ".$fila["Field"]."<br>";
        echo "Comentario de la columna: ".$fila["Comment"]."<br>";
        echo "El tipo de columna es: ".$fila["Type"]."<br>";
        echo "Vamos a ver si la columna es una clave: ".$fila["Key"]."<br>";
        echo "La columna se puede anular? ".$fila["Null"]."<br>";
            echo "<br>";
    */
    if($fila["Key"] == NULL){
    echo'
        <div class="campo">
            <label for="'.$fila["Field"].'">'.$fila["Field"].'</label>
            <p>'.$fila["Comment"].'</p>
            <input type="';
            if(strpos($fila["Type"],"varchar") !== false){
                echo "text";
            }else if(strpos($fila["Type"],"int") !== false){
                echo "number";
            }
            echo '"name="'.$fila["Field"].'" id="'.$fila["Field"].'"';
            if($fila["Null"] == "NO"){echo "required";}
            preg_match('#\((.*?)\)#',$fila["Type"], $match);
            echo'
            max = "'.$match[1].'"
            >
        </div>
    ';
    }
}

$mysqli->close();

?>
    <input type="submit">
</form>