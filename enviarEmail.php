<?php

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];
$emailDestino = $_POST["emailDestino"];
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente 
$headers .= "From: $nombre <$email>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: mariano@desarrolloweb.com\r\n";

//ruta del mensaje desde origen a destino 
//$headers .= "Return-path: holahola@desarrolloweb.com\r\n";

//direcciones que recibián copia 
//$headers .= "Cc: maria@desarrolloweb.com\r\n";

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

mail($emailDestino, $asunto, $mensaje, $headers)
?>