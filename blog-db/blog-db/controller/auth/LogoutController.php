<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

logout_user();
setmessage("You have been logged out successfully.", "success");
header("Location: index.php?page=login");
exit;
