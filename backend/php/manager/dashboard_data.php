<?php
session_start();
require_once __DIR__ . '/../../../backend/php/config.php';
require_once __DIR__ . '/../../../backend/php/auth_check.php';

checkManagerAuth();


try {
    $manager_id = $_SESSION['manager_id'];

    // جلب بيانات المدير
    $stmt = $conn->prepare("SELECT full_name FROM managers WHERE id = ?");
    $stmt->execute([$manager_id]);
    $manager = $stmt->fetch(PDO::FETCH_ASSOC);

    // جلب عدد الفعاليات
    $stmt = $conn->prepare("SELECT COUNT(*) FROM organization_activities WHERE created_by = ?");
    $stmt->execute([$manager_id]);
    $activities_count = $stmt->fetchColumn();

    // جلب آخر الفعاليات
    $stmt = $conn->prepare("SELECT * FROM organization_activities WHERE created_by = ? ORDER BY created_at DESC LIMIT 5");
    $stmt->execute([$manager_id]);
    $recent_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $manager = ['full_name' => 'غير معروف']; // تعيين قيمة افتراضية لمنع الخطأ
    $activities_count = 0;
    $recent_activities = [];
}
