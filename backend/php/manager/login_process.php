<?php
session_start();
require_once __DIR__ . '../../config.php';


// التحقق من جلسة المدير
if (isset($_SESSION['manager_id'])) {
    header("Location: /SPROJECT/frontend/html/manager/dashboard.php");
    exit();
}

$error = isset($_GET['error']) && $_GET['error'] === 'invalid' ? "البريد الإلكتروني أو كلمة المرور غير صحيحة" : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من المدراء
    $stmt = $conn->prepare("SELECT * FROM managers WHERE email = ? AND manager_type = 'activities'");
    $stmt->execute([$email]);
    $manager = $stmt->fetch();

    if ($manager && password_verify($password, $manager['password'])) {
        // استخدام جلسة منفصلة للمدير
        $_SESSION['manager_id'] = $manager['id'];
        $_SESSION['manager_username'] = $manager['username'];
        $_SESSION['manager_full_name'] = $manager['full_name'];
        $_SESSION['manager_role'] = 'manager';
        $_SESSION['manager_type'] = 'activities';
        header("Location: /SPROJECT/frontend/html/manager/dashboard.php");
        exit();
    }

    header("Location: /SPROJECT/frontend/html/manager_login.php?error=invalid");
    exit();
}
?> 