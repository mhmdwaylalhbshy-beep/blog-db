<?php
try {
    $conn = mysqli_connect("localhost", "root", "", "blog");
    if (!$conn) {
        header("Location: views/maintainance.php");
        exit;
    }
} catch (Throwable $e) {
    header("Location: views/maintainance.php");
    exit;
}
?>