<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $manager_type = isset($_POST['manager_type']) ? trim($_POST['manager_type']) : '';

    // التحقق من البيانات
    if (empty($full_name) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($manager_type)) {
        $error_message = 'جميع الحقول مطلوبة';
    } else {
        try {
            // التحقق من عدم وجود اسم مستخدم مكرر
            $check_username_stmt = $conn->prepare("SELECT id FROM managers WHERE username = ?");
            $check_username_stmt->execute([$username]);

            if ($check_username_stmt->rowCount() > 0) {
                $error_message = "اسم المستخدم موجود مسبقاً";
            } else {
                // التحقق من عدم وجود بريد إلكتروني مكرر
                $check_email_stmt = $conn->prepare("SELECT id FROM managers WHERE email = ?");
                $check_email_stmt->execute([$email]);

                if ($check_email_stmt->rowCount() > 0) {
                    $error_message = "البريد الإلكتروني موجود مسبقاً";
                } else {
                    // إضافة المدير الجديد
                    $stmt = $conn->prepare("INSERT INTO managers (full_name, username, email, phone, password, manager_type, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'active', NOW())");
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    if ($stmt->execute([$full_name, $username, $email, $phone, $hashed_password, $manager_type])) {
                        $success_message = "تم إضافة المدير بنجاح";
                        // تفريغ الحقول بعد الإضافة الناجحة
                        $full_name = $username = $email = $phone = $password = $manager_type = '';
                    } else {
                        $error_message = "حدث خطأ أثناء إضافة المدير";
                    }
                }
            }
        } catch (PDOException $e) {
            $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
        }
    }
}
