<?php
function displayNotification() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $type = $_SESSION['type']; 
        echo '<div id="notification" class="notification" style="display: none;"></div>';
        echo "<script>
                $(document).ready(function() {
                    showNotification('$message', '$type');
                });
              </script>";
        unset($_SESSION['message']);
        unset($_SESSION['type']);
    }
}
?>
