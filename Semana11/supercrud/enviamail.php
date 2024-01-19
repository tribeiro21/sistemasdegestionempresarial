<?php
    $cabeceras = 'From: tribeiro2109@gmail.com' . "\r\n" .
    'Reply-To: trodrigues2109@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $cabeceras .= 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail(
        "tony.ribeiro@energytec.es",
        "Asunto del mensaje",
        "<h1>Título</h1><p>Cuerpo del mensaje</p>",
        $cabeceras
    );

?>
    