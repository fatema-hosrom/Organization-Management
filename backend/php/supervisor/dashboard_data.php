<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$managers_count = 0;
$recent_managers = [];
$error_message = '';

try {
    // جلب عدد المدراء
    $stmt = $conn->query("SELECT COUNT(*) as count FROM managers");
    $managers_count = $stmt->fetch()['count'];

    // جلب آخر المدراء المسجلين
    $stmt = $conn->query("SELECT * FROM managers ORDER BY created_at DESC LIMIT 5");
    $recent_managers = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
} 