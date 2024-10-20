<?php

session_start();

require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/helpers/function.php';

const ALLOWED_FILES = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];

const MAX_SIZE = 5 * 1024 * 1024; //  5MB

const UPLOAD_DIR = __DIR__ . '/uploads';


$is_post_request = strtolower($_SERVER['REQUEST_METHOD']) === 'post';
$error_code = $_FILES['image']['error'];
$has_file = isset($_FILES['image']); // stores the file from the form  with a name attribute called "image";


if (!$is_post_request || !$has_file) {
    redirect_with_message(MESSAGES[$error_code], FLASH_ERROR);
}

//
$filename = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];


// an error occurs
if ($error_code !== UPLOAD_ERR_OK) {
    redirect_with_message(MESSAGES[$error_code], FLASH_ERROR);
}


// validate the file size
$filesize = filesize($tmp);

if ($filesize > MAX_SIZE) {
    redirect_with_message('Error! your file size is '
        . format_filesize($filesize)
        . ' , which is bigger than allowed size '
        . format_filesize(MAX_SIZE), FLASH_ERROR);
}

// validate the file type
$mime_type = get_mime_type($tmp);

if (!in_array($mime_type, array_keys(ALLOWED_FILES))) {
    redirect_with_message('The file type is not allowed to upload', FLASH_ERROR);
}


// set the filename as the basename + extension
$uploaded_file = pathinfo($filename, PATHINFO_FILENAME) . '.' . ALLOWED_FILES[$mime_type];
// new file location
$filepath = UPLOAD_DIR . '/' . $uploaded_file;

if (!is_dir($filepath)) {
    mkdir(UPLOAD_DIR, 0755);
}

// move the file to the upload dir
$success = move_uploaded_file($tmp, $filepath);

if ($success) {
    redirect_with_message('The file was uploaded successfully.', FLASH_SUCCESS);
}

redirect_with_message('Error moving the file to the upload folder.', FLASH_ERROR);
