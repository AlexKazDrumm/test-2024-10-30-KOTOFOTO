<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'functions.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($_GET['action'] == 'delete') {
        deleteMessage($id);
        $_SESSION['message'] = "Сообщение удалено.";
        $_SESSION['msg_type'] = "success";
    } elseif ($_GET['action'] == 'mark') {
        markMessageAsRead($id);
        $_SESSION['message'] = "Сообщение помечено как прочитанное.";
        $_SESSION['msg_type'] = "success";
    }

    header("Location: admin.php");
    exit();
}

$messages = getAllMessages();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Модерация сообщений</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'components/message.php'; ?>

    <div class="wrapper">
        <h2>Список сообщений</h2>

        <p><a href="logout.php">Выйти</a> | <a href="index.php">На главную</a></p>

        <?php
        if (isset($_SESSION['message'])):
        ?>
            <div class="message <?php echo $_SESSION['msg_type']; ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
                ?>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Сообщение</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?php echo $message['id']; ?></td>
                <td><?php echo htmlspecialchars($message['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo nl2br(htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8')); ?></td>
                <td><?php echo date('d.m.Y H:i:s', strtotime($message['created_at'])); ?></td>
                <td><?php echo $message['is_read'] ? 'Прочитано' : 'Не прочитано'; ?></td>
                <td>
                    <?php if (!$message['is_read']): ?>
                        <a href="admin.php?action=mark&id=<?php echo $message['id']; ?>">Пометить как прочитанное</a> |
                    <?php endif; ?>
                    <a href="admin.php?action=delete&id=<?php echo $message['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить это сообщение?');">Удалить</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
