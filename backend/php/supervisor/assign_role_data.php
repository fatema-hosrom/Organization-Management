<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

$success_message = '';
$error_message = '';
$managers = [];

// جلب جميع المدراء
try {
    $stmt = $conn->query("SELECT * FROM managers ORDER BY created_at DESC");
    $managers = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "حدث خطأ في جلب بيانات المدراء: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager_id = isset($_POST['manager_id']) ? trim($_POST['manager_id']) : '';
    $manager_type = isset($_POST['manager_type']) ? trim($_POST['manager_type']) : '';

    // التحقق من البيانات
    if (empty($manager_id) || empty($manager_type)) {
        $error_message = 'جميع الحقول مطلوبة';
    } else {
        try {
            // التحقق من وجود المدير
            $check_stmt = $conn->prepare("SELECT id, full_name FROM managers WHERE id = ?");
            $check_stmt->execute([$manager_id]);
            $manager = $check_stmt->fetch();

            if ($manager) {
                // التحقق من صحة نوع المدير
                if (in_array($manager_type, ['financial', 'activities'])) {
                    // تحديث نوع المدير وتاريخ التحديث
                    $stmt = $conn->prepare("UPDATE managers SET manager_type = ?, updated_at = NOW() WHERE id = ?");
                    if ($stmt->execute([$manager_type, $manager_id])) {
                        $role_name = $manager_type == 'financial' ? 'مدير مالي' : 'مدير أنشطة';
                        $success_message = "تم تحديث دور المدير " . htmlspecialchars($manager['full_name']) . " إلى " . $role_name . " بنجاح";

                        // تحديث قائمة المدراء بعد التحديث
                        $stmt = $conn->query("SELECT * FROM managers ORDER BY created_at DESC");
                        $managers = $stmt->fetchAll();
                    } else {
                        $error_message = "حدث خطأ أثناء تحديث دور المدير";
                    }
                } else {
                    $error_message = "نوع المدير غير صالح";
                }
            } else {
                $error_message = "المدير غير موجود";
            }
        } catch (PDOException $e) {
            $error_message = "حدث خطأ في قاعدة البيانات: " . $e->getMessage();
        }
    }
} 