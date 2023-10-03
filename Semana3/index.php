<?php
    $mysqli = new mysqli("localhost", "docs", "docs", "docs");
    $consulta = "SELECT * FROM cms";
    $resultado = $mysqli->query($consulta);
        while ($fila = $resultado->fetch_assoc()) {
            $cms[$fila['elemento']] = $fila['contenido'];
        }
?>
<!doctype html>
<html>
    <head>
        <link rel="Stylesheet" href="inc/estilo.css">
    </head>
    <body>
        <header>
            <h1><?php echo $cms['Titulo']?></h1>
            <h2><?php echo $cms['Subtitulo']?></h2>
            <nav>
                <ul>
                    <li><a href="?">Inicio</a></li>
                    <li><a href="?p=productos">Productos</a></li>
                    <li><a href="?p=contacto">Contacto</a></li>
                    <li><a href="?p=blog">Blog</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
                if(isset($_GET['p'])){
                    include "inc/".$_GET['p'].".php";
                }else{
                    include "inc/inicio.php";
                }
            ?> 
        </main>
        <footer>
            <?php echo $cms['Copyright']?>
        </footer>
    </body>
</html>