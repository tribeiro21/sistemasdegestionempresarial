$(document).ready(function(){
    console.log("listo");
    $("td").dblclick(function(){
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
    })
})