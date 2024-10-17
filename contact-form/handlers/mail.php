<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$phpmailer = new PHPMailer();


// get email from the config file
$config = require_once __DIR__ . '/../config/app.php';
$recipient_email = $config['mail']['to_email'];
$recipient_name = $config['mail']['to_name'];

// contact information
$contact_name = $inputs['name'];
$contact_email = $inputs['email'];
$message = $inputs['message'];
$subject = $inputs['subject'];


$phpmailer->isSMTP();
$phpmailer->Host = $_ENV['SMTP_HOST'];
$phpmailer->SMTPAuth = $_ENV['SMTP_AUTH'] === 'true';
$phpmailer->Port = (int) $_ENV['SMTP_PORT'];
$phpmailer->Username = $_ENV['SMTP_USERNAME'];
$phpmailer->Password = $_ENV['SMTP_PASSWORD'];

// echo $contact_name;

// Recipients
$phpmailer->setFrom($contact_email, $contact_name);
$phpmailer->addAddress($recipient_email, $recipient_name);

// Content
$phpmailer->isHTML(true);
$phpmailer->Subject = $subject;
$phpmailer->Body   = $message;

$mail_status = $phpmailer->send();
