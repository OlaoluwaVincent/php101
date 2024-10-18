<?php

require __DIR__ . '/validation.php';
require __DIR__ . '/sanitization.php';
require __DIR__ . '/filter.php';

$data = [
    'firstname' => '',
    'username' => 'JohnDoe',
    'address' => 'This is my address',
    'zipcode' => '999',
    'email' => 'jo@',
    'password' => 'test123',
    'password2' => 'test123',
];



$fields = [
    'firstname' => 'required | max:255',
    'lastname' => 'required | max: 255',
    'address' => 'required | min: 10, max:255',
    'zipcode' => 'between: 5,6',
    'username' => 'required | alphanumeric | between: 3,255 | unique: users,username',
    'email' => 'required | email | unique: users,email',
    'password' => 'required | secure',
    'password2' => 'required | same:password'
];


// $errors = validate(
//     $data,
//     $fields,
//     [
//         'required' => 'The %s is required',
//         'password2' => ['same' => 'Please enter the same password again']
//     ]
// );

// print_r($errors);


$inputs = [
    'name' => 'joe<script>',
    'email' => 'joe@example.com</>',
    'age' => '18abc',
    'weight' => '100.12lb',
    'github' => 'https://github.com/joe',
    'hobbies' => [
        ' Reading',
        'Running ',
        ' Programming '
    ]
];

$fields = [
    'name' => 'string',
    'email' => 'email',
    'age' => 'int',
    'weight' => 'float',
    'github' => 'url',
    'hobbies' => 'string[]'
];

// $data = sanitize($inputs, $fields);

// var_dump($data);

$data1 = [
    'name' => 'Vincent',
    'email' => 'john@email.com',
    'username' => 'usernameOneTwo',
];

$fields1 = [
    'name' => 'string | required | max: 255',
    'email' => 'email | required | email',
    'username' => 'string | required | max:255',
];

// [$inputs1, $errors1] = filter($data1, $fields1);

$pass_hash = password_hash('olaoluwa', PASSWORD_DEFAULT);

$valid = password_verify('olaoluwa', $pass_hash);

var_dump($valid ? 'Valid' : 'Not valid');
