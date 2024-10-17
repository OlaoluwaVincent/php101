<?php

$honeypot = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING);
//Check if it was filled by a BOT and redirect as METHOD NOT ALLOWED
if ($honeypot) {
    header($_SERVER['SERVER_PROTOCOL'], true, 405);
    exit;
}

// Validate the user's name
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$inputs['name'] = $name;

if (!$name || trim($name) == '') {
    $errors['name'] = 'Please enter your name.';
}

// Validate email
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$inputs['email'] = $email;

if (!$email || trim($email) === '') {
    $errors['email'] = 'Please enter your email';
}


// Validate message
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
$inputs['message'] = $message;

if (!$message || trim($message) === '') {
    $errors['message'] = 'Please enter your message';
}


// Validate subject
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$inputs['subject'] = $subject;

if (!$subject || trim($subject) === '') {
    $errors['subject'] = 'Please enter your subject';
}
