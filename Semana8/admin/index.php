<?php
error_reporting(0);
session_start();
include "../config.php";
include "../controlador.php";
$mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
$miformulario = new Supercontrolador();
?>
<html>
    <head>
        <script src="https://kit.fontawesome.com/efbb0fceea.js" crossorigin="anonymous"></script>
        <style>
            /*ESTILOS GENERALES*/
            body,html{background:rgb(220,220,220);font-family:sans-serif;padding:0px;margin:0px;height:100%;}
            /*ESTILOS FORMULARIO LOGIN*/
            #formulariologin{width:200px;height:200px;background:white;padding:30px;margin:auto;border-radius:20px;text-align:center}
            #formulariologin input{width:100%;padding-top:10px;padding-bottom:10px;border:0px;margin-top:10px;outline:none;background:rgb(240,240,240);border-radius:5px;}
            #formulariologin input[type="text"],#formulariologin input[type="password"]{box-shadow:0px 4px 8px rgba(0,0,0,0.3) inset;}
            #formulariologin input[type="submit"]{box-shadow:0px 4px 8px rgba(0,0,0,0.3);}
            .notice{position:absolute;top:0px;width:400px;background:red;color:white;height:20px;left:50%;margin-left:-200px;padding:10px;text-align:center;}
            
            /*ESTILOS PANEL DE CONTROL*/
            aside{width:20%;float:left;height:100%;box-shadow:-20px 0px 20px rgba(0,0,0,0.3) inset;}
            section{width:80%;float:right;height:100%;}
            #contienemenu{padding:10px;}
            #contienemenu ul{list-style-type:none;padding:0px;margin:0px;}
            #contienemenu ul li{padding:10px;margin:0px;border-bottom:1px solid grey;}
            #contienemenu ul li a{color:inherit;text-decoration:none;}
            #contienecontenido{padding:10px;}
            #contienecontenido table{width:100%;text-align:left;}
            #contienecontenido table a{padding:5px;color:inherit;text-decoration:none;}
            #contienecontenido table a i{font-size:20px;}
            #create{color:inherit;text-decoration:none;font-size:60px;position:absolute;bottom:10px;right:10px;}
            
            /*ESTILOS FORMULARIO*/
            #formulario{width:50%;background:grey;margin:auto;padding:30px;box-shadow:0px 15px 30px green;border-radius: 20px;text-align: center;}
            #formulario h1{color:aqua;padding:0px;margin:0px;}
            #formulario h3{text-align:left;margin:0px;padding:0px;}
            form{background:grey;color:aquamarine;}
            #formulario p{text-align:left;}
            .campo input{padding:10px;background:#DEDEDE;border:none;margin:8px;width:97%;clear:both;}
            .campo{margin-bottom:30px;}
            .campo label{font-size:4em;padding:0px;margin:0px;}
            .campo p{font-size:1em;padding:0px;margin:0px;}
            #formulario input[type="submit"]{
                border:none;
                padding:15px;
                width:150px;
                border-radius: 20px;
            }
            input{transition:all 2s;}
            input:focus{outline:none;background:aquamarine;}
            .contienecampo input{float:left;width:100%;margin-right:0px;height:15px;border-radius: 10px 0px 0px 10px;box-shadow:0px 4px 8px rgba(0,0,0,0.3) inset;}
            .contienecampo .tipocampo{float:right;width:90%;background:#DEDEDE;height: 35px;line-height:30px;border-radius: 0px 10px 10px 0px;}
            .clearfix{clear:both;}
            .contienecampo table{width:100%;}
            
        </style>
    </head>
    <body>
        <?php
            if(isset($_POST['usuario'])){
               
                include "../config.php";
                $mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
                $consulta = "SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."' AND contrasena = '".$_POST['contrasena']."'";
                $resultado = $mysqli->query($consulta);
                $pasas = "no";
                while($fila = $resultado->fetch_assoc()){
                    $pasas = "si";
                    $_SESSION['usuario'] = $fila['usuario'];
                }
                if($pasas == "si"){
                    
                }else{
                    echo '<div class="notice">Intento denegado</div>';
                }
            }
        ?>
    
        <?php
            if(isset($_SESSION['usuario'])){
                echo '
                    <aside>
                        <div id="contienemenu"><ul>';
                        $consulta = "SHOW TABLES";
                        $resultado = $mysqli->query($consulta);
                        
                        while($fila = $resultado->fetch_array()){
                            echo '<li><a href="?tabla='.$fila[0].'">'.$fila[0].'</a></li>';
                        }    
                        echo '</ul>
                        </div>
                    </aside>
                    <section>
                        <div id="contienecontenido">
                            ';
                                if(isset($_GET['tabla'])){$miformulario->leer($_GET['tabla']);}
                                if(isset($_GET['create'])){echo 'div id="formulario">';$miformulario->insertar($_GET['create']);echo '</div>';}
                            echo '
                            
                        </div>
                    </section>
                ';
            }else{
                echo '
                    <form action="?" method="POST" id="formulariologin">
                        <img src="img/5637217.png">
                        <input type="text" name="usuario" placeholder="usuario">
                        <input type="password" name="contrasena" placeholder="contraseña">
                        <input type="submit">
                    </form>
                ';
            }
        ?>
        
    </body>
</html>