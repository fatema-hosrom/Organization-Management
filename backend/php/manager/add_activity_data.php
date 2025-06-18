<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkManagerAuth('activities');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=طريقة طلب غير صحيحة");
    exit();
}

// التحقق من تكرار اسم الفعالية
$check_title = $conn->prepare("SELECT id FROM organization_activities WHERE title = ? AND created_by = ?");
$check_title->execute([$_POST['title'], $_SESSION['manager_id']]);
if ($check_title->rowCount() > 0) {
    header("Location: /SPROJECT/frontend/html/manager/activities/add_activity.php?error=اسم الفعالية مستخدم مسبقاً");
    exit();
}

// معالجة رفع الصورة
$image_name = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $image_name = uniqid('activity_') . '.' . $ext;
    $upload_path = __DIR__ . '/../../../uploads/activities/' . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
}

try {
    $stmt = $conn->prepare("INSERT INTO organization_activities (title, description, activity_type, start_date, end_date, location, required_volunteers, image, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['activity_type'],
        $_POST['start_date'],
        $_POST['end_date'],
        $_POST['location'],
        $_POST['required_volunteers'],
        $image_name,
        $_SESSION['manager_id']
    ]);
    
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?success=تم إضافة الفعالية بنجاح");
    exit();
} catch (PDOException $e) {
    header("Location: /SPROJECT/frontend/html/manager/activities/add_activity.php?error=حدث خطأ في قاعدة البيانات: " . urlencode($e->getMessage()));
    exit();
} 