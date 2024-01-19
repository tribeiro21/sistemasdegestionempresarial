$(document).ready(function(){
    $('select').select2();
    $('body').on('DOMNodeInserted', 'select', function () {
        $(this).select2().on('select2:select', function (e){
            var data = e.params.data;
            console.log(data)
            var valoraenviar = data.id
            var texto = data.text
            var tabla = $(this).parent().attr("tabla")
            var columna = $(this).parent().attr("columna")
            var identificador = $(this).parent().attr("identificador")
            console.log("voy a poner el valor "+valoraenviar+" en la tabla "+tabla+" en la columna "+columna+" y en el identificador "+identificador)
            $("#ajax").load("inc/ajaxmodifica.php?valor="+valoraenviar+"&tabla="+tabla+"&columna="+columna+"&identificador="+identificador)
            $(this).parent().html("<td><b>"+valoraenviar+"</b> - "+texto+"</td>");
        });
    });
    console.log("listo");
    $("td").dblclick(function(){
        if($(this).attr("externo") == "no"){
            var selector;
            $(this).attr('contenteditable','true').blur(function(){
                selector = $(this)
                selector.attr('contenteditable','false')
                var valoraenviar = selector.text();
                var tabla = selector.attr("tabla")
                var identificador = selector.attr("identificador")
                var columna = selector.attr("columna")
                console.log("voy a poner el valor "+valoraenviar+" en la tabla "+tabla+" en la columna "+columna+" y en el identificador "+identificador)
                $("#ajax").load("inc/ajaxmodifica.php?valor="+valoraenviar+"&tabla="+tabla+"&columna="+columna+"&identificador="+identificador)
            });
        }
        if($(this).attr("externo") == "si"){
            selector = $(this)
            var tabla = selector.attr("tablaexterna")
            var columna = selector.attr("columnaexterna")
            var clavexterna = selector.attr("clavexterna")
            $(this).load("inc/ajaxvalores.php?tabla="+tabla+"&columna="+columna+"&clavexterna="+clavexterna);
            $('select').select2();
        }
    })
    
})