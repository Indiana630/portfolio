<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tema = $_POST['tema'];
    $mensaje = $_POST['mensaje'];

    $destinatario = "pepecz6305@gmail.com";

    $asunto = "Nuevo mensaje, asunto: $tema";

    $contenido = "Nombre: $nombre\n";
    $contenido .= "Email: $email\n\n";
    $contenido .= "Tema: \n$tema\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $nombre <$email>";

    if(mail($destinatario, $asunto, $contenido, $headers)){
        echo "Tu mensaje ha sido enviado con éxito.";
    } else{
        echo "Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.";
    }
}

?>
