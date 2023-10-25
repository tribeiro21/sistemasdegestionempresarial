<!doctype html>
<html>
    <head>
        <style>
            body{font-family:sans-serif;background:#07FF9D;}
            #formulario{width:50%;background:grey;margin:auto;padding:30px;box-shadow:0px 15px 30px green;border-radius: 20px;text-align: center;}
            #formulario h1{color:aqua;padding:0px;margin:0px;}
            form{background:grey;color:aquamarine;}
            #formulario p{text-align:left;}
            .campo input{padding:10px;background:#DEDEDE;border:none;margin:8px;width:97%;}
            .campo{margin-bottom:30px;}
            .campo label{font-size:4em;padding:0px;margin:0px;}
            .campo p{font-size:1em;padding:0px;margin:0px;}
            #formulario input[type="submit"]{
                border:none;
                padding:15px;
                width:150px;
                border-radius: 20px;
            }
            
        </style>
    </head>
    <body>
        <div id="formulario">
            <img src="img/5637217.png">
            <h1>Rellena los campos para completar la entrega</h1>
            <?php
            include "controlador.php";
            $miformulario = new Supercontrolador();
            if(isset($_POST['clave']) && $_POST['clave'] = 'procesaformulario'){
                $miformulario->procesaformulario("entregas");
            }else{
                $miformulario->formulario("entregas");
            }
            ?>
        </div>
        
    </body>
</html>
