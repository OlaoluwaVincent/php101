<?php
session_start();
require __DIR__ . '/inc/header.php';

$errors = [];
$inputs = [];

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);


if ($request_method === 'GET') {
    // show the form

    if (isset($_SESSION['name'])) {
        require __DIR__ . '/login.php';
    }
    require __DIR__ . '/inc/form.php';
} elseif ($request_method === 'POST') {
    // handle the form submission
    require    __DIR__ .  '/inc/post.php';
    // show the form if the error exists
    if (count($errors) > 0) {
        require __DIR__ . '/inc/form.php';
    }
}

require __DIR__ .  '/inc/footer.php';
