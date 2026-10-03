<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $error = validateContact($name, $email, $phone, $message);
    if (!empty($error)) {
        setmessage($error, "danger");
        header("Location: index.php?page=contact");
        exit;
    }

    if (insert_contact_message($name, $email, $phone, $message)) {
        setmessage("Your message has been sent successfully! Thank you.", "success");
        header("Location: index.php?page=contact");
        exit;
    } else {
        setmessage("Failed to send your message. Please try again.", "danger");
        header("Location: index.php?page=contact");
        exit;
    }
} else {
    header("Location: index.php?page=contact");
    exit;
}
?>
