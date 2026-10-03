<?php

$action = $_GET['action'] ?? $_POST['action'] ?? 'store';

if ($action === "delete") {
    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    delete($id);

} 
elseif ($action === "update") {
    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    
    $title = trim($_POST['title'] ?? '');
    $image = $_FILES['image'] ?? null;
    $content = trim($_POST['content'] ?? '');
    update($id, $title, $content, $image);
} 

elseif ($action === "store" || $_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title'] ?? '');
    $image = $_FILES['image'] ?? null;
    $content = trim($_POST['content'] ?? '');
    store($title, $content, $image);
} 

else {
    header("Location: index.php?page=home");
    exit;
}

function store($title, $content, $image)
{
    $error = validatePost($title, $image, $content);
    if (!empty($error)) {
        setmessage($error, "danger");
        header("Location: index.php?page=post");
        exit;
    }

    if (insert_post($title, $image, $content)) {
        setmessage("Blog Created Successfully", "success");
        header("Location: index.php?page=home");
        exit;
    } else {
        setmessage("Failed to create your post. Please try again.", "danger");
        header("Location: index.php?page=post");
        exit;
    }
}

function update($id, $title, $content, $image)
{
    if (!$id) {
        setmessage("Invalid post ID.", "danger");
        header("Location: index.php?page=home");
        exit;
    }

    $error = validatePost($title, $image, $content, true);
    if (!empty($error)) {
        setmessage($error, "danger");
        header("Location: index.php?page=edit_post&id=" . $id);
        exit;
    }

    if (update_post($id, $title, $content, $image)) {
        setmessage("Blog Updated Successfully", "success");
        header("Location: index.php?page=home");
        exit;
    } else {
        setmessage("Failed to update your post. Please try again.", "danger");
        header("Location: index.php?page=edit_post&id=" . $id);
        exit;
    }
}

function delete($id)
{
    if (!$id) {
        setmessage("Invalid post ID.", "danger");
        header("Location: index.php?page=home");
        exit;
    }

    if (delete_post($id)) {
        setmessage("Blog Deleted Successfully", "success");
        header("Location: index.php?page=home");
        exit;
    } else {
        setmessage("Failed to delete your post. Please try again.", "danger");
        header("Location: index.php?page=home");
        exit;
    }
}
