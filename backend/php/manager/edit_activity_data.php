<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkManagerAuth();

// التحقق من وجود معرف النشاط
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=invalid_id");
    exit();
}

// جلب معرف النشاط من GET أو POST
$activity_id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];

// جلب بيانات النشاط
try {
    $stmt = $conn->prepare("
        SELECT 
            id,
            title,
            description,
            activity_type,
            DATE_FORMAT(start_date, '%Y-%m-%d %H:%i') as start_date,
            DATE_FORMAT(end_date, '%Y-%m-%d %H:%i') as end_date,
            location,
            required_volunteers,
            image,
            DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at
        FROM organization_activities 
        WHERE id = ? AND created_by = ?
    ");
    
    $stmt->execute([$activity_id, $_SESSION['manager_id']]);
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$activity) {
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=activity_not_found");
        exit();
    }
} catch (PDOException $e) {
    error_log("Error in edit_activity_data.php: " . $e->getMessage());
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=database_error");
    exit();
}

// إذا كان الطلب POST، قم بمعالجة التحديث
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // التحقق من تكرار اسم الفعالية
    $check_title = $conn->prepare("SELECT id FROM organization_activities WHERE title = ? AND created_by = ? AND id != ?");
    $check_title->execute([$_POST['title'], $_SESSION['manager_id'], $activity_id]);
    if ($check_title->rowCount() > 0) {
        header("Location: /SPROJECT/frontend/html/manager/activities/edit_activity.php?id=" . $activity_id . "&error=اسم الفعالية مستخدم مسبقاً");
        exit();
    }

    // معالجة رفع الصورة
    $image_name = $activity['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid('activity_') . '.' . $ext;
        $upload_path = __DIR__ . '/../../../uploads/activities/' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
    }

    try {
        $stmt = $conn->prepare("UPDATE organization_activities SET title = ?, description = ?, activity_type = ?, start_date = ?, end_date = ?, location = ?, required_volunteers = ?, image = ? WHERE id = ? AND created_by = ?");
        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['activity_type'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['location'],
            $_POST['required_volunteers'],
            $image_name,
            $activity_id,
            $_SESSION['user_id']
        ]);
        
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?success=تم تحديث الفعالية بنجاح");
        exit();
    } catch (PDOException $e) {
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=حدث خطأ في قاعدة البيانات: " . urlencode($e->getMessage()));
        exit();
    }
} 