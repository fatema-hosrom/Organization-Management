<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

// جلب جميع المدراء
$stmt = $conn->query("SELECT * FROM managers ORDER BY created_at DESC");
$managers = $stmt->fetchAll();
