<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>

<?php view('header', ['title' => 'Login']) ?>

<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>

<form action="../src/login.php" method="post">
    <h1>Login</h1>
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <small id="usercheck"><?= $errors['username'] ?? 'Please Provide Username' ?></small>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <small id="passcheck"><?= $errors['password'] ?? 'Please Provide Password' ?></small>
    </div>
    <section>
        <button type="submit">Login</button>
        <a href="register.php">Register</a>
    </section>
</form>

<?php view('footer') ?>