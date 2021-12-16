<?php 
use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;

require  'PHPMailer/Exception.php';
require  'PHPMailer/PHPMailer.php';
require  'PHPMailer/SMTP.php';

$mail = new PHPMailer();

try {
$cuerpoMail = utf8_decode("<b><h4>Hola, te saluda el SUTC, SISTEMA UNICO DE TARJETONES DE COLOMBIA</h4><b>
                            <h5>Le indicamos los proximos vencimientos:</h5>
                            <h6> - Licencia (2021-12-15)</h6>
                            <h6> - Soat (2021-12-16)</h6>
                            ");	 


$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "pruebahost19@gmail.com";
$mail->Password = "123456789-a";									
$mail->setFrom( 'pruebahost19@gmail.com'  );
$mail->addAddress ( 'tony.dev08@gmail.com' );									
$mail->Subject='SUTC';
$mail->From ="pruebahost19@gmail.com";
$mail->FromName = "SUTC"; 
$mail->MsgHTML($cuerpoMail);
$mail->IsHTML(true);
$mail->Send();
echo  "Mensaje Enviado" ;
}catch( Exception  $e ) {
    echo  "No se pudo enviar el mensaje. Error de mail: {$mail-> ErrorInfo}" ;
}
/*
try {

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));


     // Configuración del servidor 
    $mail->SMTPDebug   = 0;                      // Habilita la salida de depuración detallada 
    $mail->isSMTP ();                                            // Enviar usando SMTP 
    $mail->Host        = 'smtp.gmail.com';                     // Configure el servidor SMTP para enviar a través de 
    $mail->SMTPAuth    = true ;                                   // Habilita la autenticación SMTP 
    $mail->Username  = 'pruebahost19@gmail.com';                     // Nombre 
    $mail->Password  = '123456789-a';                               // Contraseña SMTP 
    $mail->SMTPSecure = PHPMailer :: ENCRYPTION_SMTPS;            // Habilita el cifrado TLS implícito 
    $mail->Port        = 587;                                    // Puerto TCP al que conectarse; use 587 si ha configurado `SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS`

    // Destinatarios 
    $mail->setFrom( 'pruebahost19@gmail.com'  );
    $mail->addAddress ( 'santiagope@visualsat.com' );    // Agrega un destinatario 

    // Archivos adjuntos 
    //$mail -> addAttachment ( '/var/tmp/file.tar.gz' );         // Agregar archivos adjuntos 
    //$mail -> addAttachment ( '/tmp/image.jpg' , 'new.jpg' );    // Nombre opcional

    // Contenido 
    $mail->isHTML(true);                                  // Establecer el formato de mail electrónico en HTML 
    $mail->subject = 'hola mundo 900%';
    $mail->Body    = '¡Este es el cuerpo del mensaje HTML <b> Gracias por preferirnos </b>';

    $mail->send();
    echo  'Mensaje enviado' ;
} catch( Exception  $e ) {
     echo  "No se pudo enviar el mensaje. Error de mail: {$mail-> ErrorInfo}" ;
}*/