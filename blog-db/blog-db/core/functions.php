<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setmessage($message, $type = "danger") {
    $_SESSION['message'] = [
        'text' => $message,
        'type' => $type
    ];
}

function showmessage() {
    if (isset($_SESSION['message']) && !empty($_SESSION['message']['text'])) {
        $text = htmlspecialchars($_SESSION['message']['text']);
        $type = htmlspecialchars($_SESSION['message']['type']);
        echo "<div class='alert alert-{$type} alert-dismissible fade show my-3' role='alert'>
                {$text}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        unset($_SESSION['message']);
    }
    return "";
}

function get_datajeson() {
    $employee = __DIR__ . "/../data/data.json";
    if (file_exists($employee)) {
        return json_decode(file_get_contents($employee), true);
    }
    return [];
}
function register_user($name, $email, $phone, $password)
{
    $conn = $GLOBALS['conn'];

    // Check if the email already exists
    $sql = "SELECT id FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    setmessage("Email already exists.", "danger");
    return false;
}


    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (name, email, phone, password)
            VALUES ('$name', '$email', '$phone', '$password')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
        ];
        header("Location: index.php?page=home");

        return true;
    }
}
function login_user($email,$password)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
        return true;
    }
    return false;
}

function logout_user()
{
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
}

function insert_contact_message($name, $email, $phone, $message)
{
    $conn = $GLOBALS['conn'];

    $sql = "INSERT INTO messages (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    return mysqli_query($conn, $sql) ? true : false;
}
function insert_post($title, $image, $content)
{
    $conn = $GLOBALS['conn'];
    $imageData = null;

    if ($image && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
        $mime = mime_content_type($image['tmp_name']);
        $base64 = base64_encode(file_get_contents($image['tmp_name']));
        $imageData = 'data:' . $mime . ';base64,' . $base64;
    }

    if ($imageData !== null) {
        $stmt = mysqli_prepare($conn, "INSERT INTO posts(title, content, image, created_at) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $imageData);
        return mysqli_stmt_execute($stmt);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO posts(title, content, image, created_at) VALUES (?, ?, NULL, NOW())");
        mysqli_stmt_bind_param($stmt, "ss", $title, $content);
        return mysqli_stmt_execute($stmt);
    }
}

function delete_post($id)
{
    $conn = $GLOBALS['conn'];
    $id = (int)$id;
    $stmt = mysqli_prepare($conn, "DELETE FROM posts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

function get_post_by_id($id)
{
    $conn = $GLOBALS['conn'];
    $id = (int)$id;
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function update_post($id, $title, $content, $image = null)
{
    $conn = $GLOBALS['conn'];
    $id = (int)$id;

    if ($image && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
        $mime = mime_content_type($image['tmp_name']);
        $base64 = base64_encode(file_get_contents($image['tmp_name']));
        $imageData = 'data:' . $mime . ';base64,' . $base64;

        $stmt = mysqli_prepare($conn, "UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $imageData, $id);
        return mysqli_stmt_execute($stmt);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE posts SET title = ?, content = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
        return mysqli_stmt_execute($stmt);
    }
}

function get_all_posts()
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);// returns an array مهمه 
}
?>
