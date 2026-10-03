<?php
define('APP_RUNNING', true);

require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/core/functions.php";
require_once __DIR__ . "/core/validation.php";

$page = isset($_GET['page']) ? $_GET['page'] : (isset($_GET['pages']) ? $_GET['pages'] : "home");

if ($page === "signup") {
    include __DIR__ . "/controller/auth/RegisterController.php";
    exit;
} elseif ($page === "auth_login") {
    include __DIR__ . "/controller/auth/LoginController.php";
    exit;
} elseif ($page === "logout") {
    include __DIR__ . "/controller/auth/LogoutController.php";
    exit;
} elseif ($page === "send_message") {
    include __DIR__ . "/controller/ContactController.php";
    exit;
}
elseif ($page === "add_post" || $page === "store_post" || $page === "delete_post" || $page === "update_post") {
    include __DIR__ . "/controller/PostController.php";
    exit;
}

$pageTitle = ucfirst($page);

require_once __DIR__ . "/views/layout/header.php";

switch ($page) {
    case "home":
        include __DIR__ . "/views/home.php";
        break;
    case "register":
        include __DIR__ . "/views/auth/register.php";
        break;
    case "login":
        include __DIR__ . "/views/auth/login.php";
        break;
    case "contact":
        include __DIR__ . "/views/contact.php";
        break;
    case "post":
    case "create_post":
        include __DIR__ . "/views/posts/create_post.php";
        break;
    case "edit_post":
        include __DIR__ . "/views/posts/edit_post.php";
        break;    

    default:
        include __DIR__ . "/views/404.php";
        break;
}

require_once __DIR__ . "/views/layout/footer.php";
?>