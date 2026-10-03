<?php

function validate_require($data,$field_name) {
if (empty($data)) {
        return "$field_name is required.";
    }
    return "";

}
function validate_email($email) {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //true or false
        return "Invalid email format.";
    }
    return "";
}

function validate_phone($phone) {
if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        return "Invalid phone number format.";
    }
    return "";
}
function validate_password($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one special character.";
    }
    return "";
}
function validate_passwordmatch($password,$confirm_password)
{
    if ($password !== $confirm_password) {
        return "Passwords do not match.";
    }
        return "";
    
}
function add_error(&$errors, $error)
{
    if ($error) {
        $errors[] = $error;
    }
}
function validateRegister($name, $email,$phone, $password)
{
    $fields = [
        "name" => $name,
        "phone" => $phone,
        "email" => $email,
        "password" => $password,
    ];

    foreach ($fields as $fieldName => $value) {
        $error = validate_require($value, $fieldName);

        if ($error) {
            return $error;
        }
    }

    $error = validate_email($email);

    if ($error) {
        return $error;
    }

    $error = validate_phone($phone);
       if ($error) {
        return $error;
    }

    $error = validate_password($password);

    if ($error) {
        return $error;
    }


    return null;
}


function validateLogin($email, $password)
{
    $fields = [
        "email" => $email,
        "password" => $password,
    ];

    foreach ($fields as $fieldName => $value) {
        $error = validate_require($value, $fieldName);

        if ($error) {
            return $error;
        }
    }

    $error = validate_email($email);

    if ($error) {
        return $error;
    }

    return null;
}

function validateContact($name, $email, $phone, $message)
{
    $fields = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "message" => $message,
    ];

    foreach ($fields as $fieldName => $value) {
        $error = validate_require($value, $fieldName);
        if ($error) {
            return $error;
        }
    }

    $error = validate_email($email);
    if ($error) {
        return $error;
    }

    $error = validate_phone($phone);
    if ($error) {
        return $error;
    }

    if (strlen($message) < 5) {
        return "Message must be at least 5 characters.";
    }

    return null;
}

function validatePost($title, $image, $content, $isUpdate = false)
{
    $fields = [
        "title" => $title,
        "content" => $content,
    ];

    if (!$isUpdate) {
        $fields["image"] = $image['name'] ?? null;
    }

    foreach ($fields as $fieldName => $value) {
        $error = validate_require($value, $fieldName);
        if ($error) {
            return $error;
        }
    }

    if (!empty($image['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'] ?? '', $allowedTypes)) {
            return "Invalid image format. Only JPEG, PNG, and GIF are allowed.";
        }
    }

    return null;
}
?>