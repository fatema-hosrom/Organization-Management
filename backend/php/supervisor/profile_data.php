<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$supervisor = null;
$error_message = '';

try {
    $stmt = $conn->prepare("SELECT * FROM supervisor WHERE id = ?");
    $stmt->execute([$_SESSION['supervisor_id']]);
    $supervisor = $stmt->fetch();

    if (!$supervisor) {
        header("Location: /SPROJECT/frontend/html/supervisor_login.php");
        exit();
    }
} catch (PDOException $e) {
    $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
}
?> 