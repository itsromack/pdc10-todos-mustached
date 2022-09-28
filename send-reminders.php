<?php

include "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);

$students = [
    [
        "name" => "Karylle",
        "gender" => "Female",
        "email" => "karylle@student.auf.edu.ph"
    ],
    [
        "name" => "Ryan Matthew",
        "gender" => "Male",
        "email" => "ryan@student.auf.edu.ph"
    ]
];

$template = $mustache->loadTemplate('reminder-message');

$mail = new PHPMailer(true);
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host = 'smtp.mailtrap.io';                     		//Set the SMTP server to send through
$mail->SMTPAuth = true;                                   	//Enable SMTP authentication
$mail->Username = '2a38286a946b03';                     	//SMTP username
$mail->Password = 'ea81c227c2ebac';                         //SMTP password
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port = 2525;         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

foreach ($students as $student) {
    $name = $student['name'];
    $email = $student['email'];
    $message = $template->render(compact('name'));

    try {
        $mail->setFrom('ccs-pdc10@auf.edu.ph', 'PDC10');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'AUF Reminders';
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->send();
        error_log('Message has been sent');
    } catch (Exception $e) {
        error_log($e->getMessage());
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

