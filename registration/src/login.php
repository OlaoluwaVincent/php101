<?php
require_once __DIR__ . '/../src/bootstrap.php';

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 25 | unique: users, username',
        'password' => 'string | required | secure',
    ];


    [$inputs, $errors] = filter($_POST, $fields);

    if ($errors) {
        redirect_with('../public/login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    if (!login($inputs['username'], $inputs['password'])) {

        $errors['login'] = 'Invalid username or password';

        redirect_with('../public/login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    redirect_to('.../index.php');
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
