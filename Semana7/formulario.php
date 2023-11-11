<!doctype html>
<html>
    <head>
        <script src="https://kit.fontawesome.com/efbb0fceea.js" crossorigin="anonymous"></script>
        <style>
            body{font-family:sans-serif;background:#07FF9D;}
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
        <div id="formulario">
            <img src="img/5637217.png">
            <h1>Rellena los campos para completar la entrega</h1>
            <?php
            //include "codificador.php";
            include "controlador.php";
            $miformulario = new Supercontrolador();
            if(isset($_POST['clave']) && $_POST['clave'] = 'procesaformulario'){
                $miformulario->procesaformulario("entregas");
            }else{
                $miformulario->formulario("entregas");
            }
            include "registro.php";
            ?>
        </div>
        
    </body>
</html>
