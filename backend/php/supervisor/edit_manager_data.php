<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$success_message = '';
$error_message = '';
$manager = null;

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM managers WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $manager = $stmt->fetch();

    if (!$manager) {
        header("Location: ../../../frontend/html/supervisor/managers.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // التحقق من أن البيانات المطلوبة موجودة
    if (empty($full_name) || empty($username) || empty($email) || empty($phone) || empty($status)) {
        $error_message = 'جميع الحقول مطلوبة';
    } else {
        try {
            // التحقق من عدم وجود اسم مستخدم مكرر
            $check_username_stmt = $conn->prepare("SELECT id FROM managers WHERE username = ? AND id != ?");
            $check_username_stmt->execute([$username, $_GET['id']]);

            if ($check_username_stmt->rowCount() > 0) {
                $error_message = "اسم المستخدم موجود مسبقاً";
            } else {
                // التحقق من عدم وجود بريد إلكتروني مكرر
                $check_email_stmt = $conn->prepare("SELECT id FROM managers WHERE email = ? AND id != ?");
                $check_email_stmt->execute([$email, $_GET['id']]);

                if ($check_email_stmt->rowCount() > 0) {
                    $error_message = "البريد الإلكتروني موجود مسبقاً";
                } else {
                    if (!empty($new_password)) {
                        $stmt = $conn->prepare("UPDATE managers SET full_name = ?, username = ?, email = ?, phone = ?, password = ?, status = ? WHERE id = ?");
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $params = [$full_name, $username, $email, $phone, $hashed_password, $status, $_GET['id']];
                    } else {
                        $stmt = $conn->prepare("UPDATE managers SET full_name = ?, username = ?, email = ?, phone = ?, status = ? WHERE id = ?");
                        $params = [$full_name, $username, $email, $phone, $status, $_GET['id']];
                    }

                    if ($stmt->execute($params)) {
                        $success_message = "تم تحديث بيانات المدير بنجاح";
                        // تحديث بيانات المدير في المتغير
                        $manager['full_name'] = $full_name;
                        $manager['username'] = $username;
                        $manager['email'] = $email;
                        $manager['phone'] = $phone;
                        $manager['status'] = $status;
                    } else {
                        $error_message = "حدث خطأ أثناء تحديث بيانات المدير";
                    }
                }
            }
        } catch (PDOException $e) {
            $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
        }
    }
}
