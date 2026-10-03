<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $error = validateLogin($email, $password);
    if (!empty($error)) {
        setmessage($error, "danger");
        header("Location: index.php?page=login");
        exit;
    }

    if (login_user($email, $password)) {
        setmessage("Login successful! Welcome back.", "success");
        header("Location: index.php?page=home");
        exit;
    } else {
        setmessage("Invalid email or password.", "danger");
        header("Location: index.php?page=login");
        exit;
    }

} else {
    header("Location: index.php?page=login");
    exit;
}
?>