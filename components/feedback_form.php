<form action="index.php" method="post" id="feedbackForm">
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>

    <label for="email">Электронная почта:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>

    <label for="message">Сообщение:</label>
    <textarea id="message" name="message" required><?php echo isset($_SESSION['form_data']['message']) ? htmlspecialchars($_SESSION['form_data']['message'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>

    <button type="submit" name="feedback_submit">Отправить</button>
</form>
