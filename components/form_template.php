<div class="container">
    <?php if (isset($form_title)): ?>
        <h2><?php echo htmlspecialchars($form_title); ?></h2>
    <?php endif; ?>

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

    <?php
    if (isset($form_file)) {
        include $form_file;
    }
    ?>
</div>
