<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $error = validateRegister($name, $email, $phone, $password);
    if (!empty($error)) {
        setmessage($error, "danger");
        header("Location: index.php?page=register");
        exit;
    }

    if (register_user($name, $email, $phone, $password)) {
        setmessage("Registration successful!", "success");
        header("Location: index.php?page=home");
        exit;
    } else {
        header("Location: index.php?page=register");
        exit;
    }

} else {
    header("Location: index.php?page=register");
    exit;
}
?>