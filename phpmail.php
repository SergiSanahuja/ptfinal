<!-- Adrián García Domínguez -->
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';



$mail = new PHPMailer(true);

try {
   //Server settings
   $mail->SMTPDebug = 0;                      
   $mail->isSMTP();                                           
   $mail->Host       = 'smtp.gmail.com';                    
   $mail->SMTPAuth   = true;                                   
   $mail->Username   = 'sergisato70@gmail.com';                     
   $mail->Password   = 'xuxp wzkf dpkq nseo';                              
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
   $mail->Port       = 465;                                   
   //Recipients
   $mail->setFrom('sergisato70@gmail.com', 'Sergi Sanahuja');
   $mail->addAddress($correu);     //Add a recipient  //Name is optional
   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = $assumpte;
   $mail->Body    = $missatge;
   $mail->send();
} catch (Exception $e) {
   $errors .= 'Ha ocurrido un error en el envío.' . $mail->ErrorInfo;
}



?>