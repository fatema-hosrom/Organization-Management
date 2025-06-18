<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$manager = null;
$error_message = '';

if (isset($_GET['id'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM managers WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $manager = $stmt->fetch();
        
        if (!$manager) {
            header("Location: ../../../frontend/html/supervisor/managers.php");
            exit();
        }
    } catch (PDOException $e) {
        $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
    }
} else {
    header("Location: ../../../frontend/html/supervisor/managers.php");
    exit();
}

