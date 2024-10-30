<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login_submit'])) {
        require_once 'functions.php';

        $username = sanitizeInput($_POST['username']);
        $password = $_POST['password'];

        if (checkAdminCredentials($username, $password)) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION['message'] = "Неверное имя пользователя или пароль.";
            $_SESSION['msg_type'] = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'components/message.php'; ?>

    <?php
    $form_title = "Авторизация администратора";
    $form_file = 'components/login_form.php';
    include 'components/form_template.php';
    ?>
</body>
</html>
