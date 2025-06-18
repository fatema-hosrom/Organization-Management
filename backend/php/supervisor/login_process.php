<?php
session_start();
require_once __DIR__ . '../../config.php';


// التحقق من جلسة المشرف
if (isset($_SESSION['supervisor_id'])) {
    header("Location: /SPROJECT/frontend/html/supervisor/dashboard.php");
    exit();
}

$error = isset($_GET['error']) && $_GET['error'] === 'invalid' ? "البريد الإلكتروني أو كلمة المرور غير صحيحة" : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من المشرف
    $stmt = $conn->prepare("SELECT * FROM supervisor WHERE email = ?");
    $stmt->execute([$email]);
    $supervisor = $stmt->fetch();

    if ($supervisor && password_verify($password, $supervisor['password'])) {
        // استخدام جلسة منفصلة للمشرف
        $_SESSION['supervisor_id'] = $supervisor['id'];
        $_SESSION['supervisor_username'] = $supervisor['username'];
        $_SESSION['supervisor_full_name'] = $supervisor['full_name'];
        $_SESSION['supervisor_role'] = 'supervisor';
        header("Location: /SPROJECT/frontend/html/supervisor/dashboard.php");
        exit();
    }

    

    header("Location: /SPROJECT/frontend/html/supervisor_login.php?error=invalid");
    exit();
}
?> 