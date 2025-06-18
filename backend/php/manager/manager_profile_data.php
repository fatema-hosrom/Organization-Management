<?php
session_start();
require_once __DIR__ . '/../../../backend/php/config.php';
require_once __DIR__ . '/../../../backend/php/auth_check.php';

// التحقق من صلاحيات المستخدم
checkManagerAuth();

try {
    $stmt = $conn->prepare("SELECT * FROM managers WHERE id = ?");
    $stmt->execute([$_SESSION['manager_id']]);
    $manager = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$manager) {
        header("Location: /SPROJECT/frontend/html/manager_login.php");
        exit();
    }
} catch (PDOException $e) {
    die("حدث خطأ في قاعدة البيانات: " . $e->getMessage());
} 