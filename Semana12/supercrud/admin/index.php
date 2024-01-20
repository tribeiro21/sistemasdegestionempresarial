<?php
error_reporting(0);
session_start();
include "../config.php";
include "../controlador.php";
include "inc/condicionesdeinicio.php";
$mysqli = new mysqli($mydbserver, $mydbuser, $mydbpassword, $mydb);
$miformulario = new Supercontrolador();
?>
<html>
    <head>
        <script src="https://kit.fontawesome.com/efbb0fceea.js" crossorigin="anonymous"></script>
        <link rel="Stylesheet" href="css/estilo.css">
        <script src="lib/jquery-3.7.1.min.js"></script>
        
        <style>
            
            
        </style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <body>
        <?php
            if(isset($_GET['pagina'])){
                switch($_GET['pagina']){
                    case "anterior":
                        if($_SESSION['pagina'] > 0){
                            $_SESSION['pagina']--;
                        }
                        break;
                    case "siguiente":
                        $_SESSION['pagina']++;
                        break;
                    case "primera":
                        $_SESSION['pagina'] = 0;
                        break;
                }
            }
            if(isset($_POST['usuario']) && !isset($_SESSION['usuario'])){
               
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
                        
                        while($fila = $resultado->fetch_array()) {
                            $consulta2 = "SHOW TABLE STATUS WHERE Name='".$fila[0]."' ";
                            //echo $consulta2;
                            
                            $resultado2 = $mysqli->query($consulta2);
                            while($fila2 = $resultado2->fetch_array()) {
                                if(json_decode($fila2["Comment"])->titulo == ""){
                                    echo '<li><a href="?tabla='.$fila[0].'"><i class="fas fa-arrow-circle-right"></i> '.$fila[0].'</a></li>';
                                }else{
                                    echo '<li><a href="?tabla='.$fila[0].'" title="'.json_decode($fila2["Comment"])->descripcion.'"> <i class="'.json_decode($fila2["Comment"])->icono.'"></i> '.json_decode($fila2["Comment"])->titulo.'</a></li>';
                                }
                                
                            }
                            

                        }    
                        echo '</ul>
                        </div>
                    </aside>
                    <section>
                        <div id="contienecontenido">
                            ';
                                if(isset($_GET['informe'])){$miformulario->informe($_GET['tabla'],$_GET['informe']);}
                                if(isset($_GET['delete'])){$miformulario->delete($_GET['tabla'],$_GET['delete']);}
                                if(isset($_GET['update'])){echo '<div id="formulario">';$miformulario->update($_GET['tabla'],$_GET['update']);echo '</div>';}
                                if($_POST['clave'] == "procesainsertar"){$miformulario->procesainsertar();}
                                if($_POST['clave'] == "procesaupdate"){$miformulario->procesaupdate($_POST['tabla'],$_POST['identificador']);}
                                if(
                                isset($_GET['tabla'])
                                && (!isset($_GET['informe']) && !isset($_GET['delete']) && !isset($_GET['update']))
                                ){$miformulario->leer($_GET['tabla']);}
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
        <div id="ajax"></div>
        <script src="js/codigo.js"></script>
    </body>
</html>