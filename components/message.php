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
    <script>
        setTimeout(function() {
            var message = document.querySelector('.message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
    </script>
<?php endif; ?>
