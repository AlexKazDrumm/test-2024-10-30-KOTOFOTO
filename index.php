<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['feedback_submit'])) {
        require_once 'functions.php';

        $name = sanitizeInput($_POST["name"]);
        $email = sanitizeInput($_POST["email"]);
        $message = sanitizeInput($_POST["message"]);

        $_SESSION['form_data'] = $_POST;

        if (!empty($name) && !empty($email) && !empty($message)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = "Пожалуйста, введите корректный адрес электронной почты.";
                $_SESSION['msg_type'] = "error";
            } else {
                try {
                    saveFeedback($name, $email, $message);
                    $_SESSION['message'] = "Ваше сообщение успешно отправлено!";
                    $_SESSION['msg_type'] = "success";
                    unset($_SESSION['form_data']);
                } catch (Exception $e) {
                    $_SESSION['message'] = "Ошибка при сохранении данных: " . $e->getMessage();
                    $_SESSION['msg_type'] = "error";
                }
            }
        } else {
            $_SESSION['message'] = "Пожалуйста, заполните все поля формы.";
            $_SESSION['msg_type'] = "error";
        }

        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-right">
        <a href="login.php">Модерация</a>
    </div>

    <?php include 'components/message.php'; ?>

    <?php
    $form_title = "Форма обратной связи";
    $form_file = 'components/feedback_form.php';
    include 'components/form_template.php';
    ?>
</body>
</html>
