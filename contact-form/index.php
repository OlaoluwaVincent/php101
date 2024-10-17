<?php
session_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();



$errors = [];
$inputs = [];
$mail_status = false;

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'GET') {

    // show the message
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    } elseif (isset($_SESSION['inputs']) && isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $inputs = $_SESSION['inputs'];
        unset($_SESSION['inputs']);
    }
    // show the form
    require_once __DIR__ . '/components/form.php';
} elseif ($request_method === 'POST') {
    // check the honeypot and validate the field
    require_once __DIR__ . '/handlers/post.php';

    if (!$errors) {
        // send an email
        require_once __DIR__ . '/handlers/mail.php';
        if ($mail_status) {
            $_SESSION['message'] =  'Thanks for contacting us! We will be in touch with you shortly.';
        } else {
            $_SESSION['message'] = 'Mail was not delivered';
        }
        // set the message
    } else {
        $_SESSION['errors'] =   $errors;
        $_SESSION['inputs'] =   $inputs;
    }

    header('Location: index.php', true, 303);
    exit;
}


require_once __DIR__ . "/includes/footer.php";
