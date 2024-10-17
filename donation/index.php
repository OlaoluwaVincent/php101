<?php
session_start();
require __DIR__ . '/inc/header.php';
const MIN_DONATION = 1;

$errors = [];
$inputs = [];
$valid = false;

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'POST') {
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
    $inputs['amount'] = $amount;
    if (isset($amount)) {
        $amount = filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT, ['options' => ['min_range' => MIN_DONATION]]);

        if ($amount === false || $amount <= 0) {
            $errors['amount'] = "The minumim amount is $" . MIN_DONATION;
        } else {
            $valid = true;
        }
    } else {
        $errors['amount'] = "Please enter a donation greater than $" . MIN_DONATION;
    }

    $_SESSION['valid'] = $valid;
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $inputs;

    header('Location: index.php', false, 303);
    exit;
} elseif ($request_method === 'GET') {
    if (isset($_SESSION['valid'])) {
        $valid = $_SESSION['valid'];
        unset($_SESSION['valid']);
    }

    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['inputs'])) {
        $inputs = $_SESSION['inputs'];
        unset($_SESSION['inputs']);
    }
}

?>



<form action="index.php" method="post">
    <?= php_ini_loaded_file(); ?>
    <h1>Donation</h1>
    <?php if ($valid) : ?>
        <div class="alert alert-success">
            Thank you for your donation of $<?= $inputs['amount'] ?? '' ?>
        </div>
    <?php endif ?>
    <div>
        <label for="amount">Amount:</label>
        <input type="text" name="amount" value="<?= $inputs['amount'] ?? '' ?>" id="amount" placeholder="Minimum donation $<?= MIN_DONATION ?>">
        <small><?= $errors['amount'] ??  '' ?></small>
    </div>
    <button type="submit">Donate</button>
</form>

<?php
require __DIR__ . '/inc/footer.php';

?>