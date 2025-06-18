<?php
session_start();
require_once "../config.php";
require_once "../auth_check.php";

// التحقق من أن المستخدم مسجل الدخول وهو مدير أنشطة
checkManagerAuth();

if (!isset($_GET['id'])) {
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=invalid_id");
    exit();
}

$activity_id = $_GET['id'];

try {
    // التحقق من أن الفعالية تنتمي للمدير الحالي
    $check_sql = "SELECT id, image FROM organization_activities WHERE id = ? AND created_by = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->execute([$activity_id, $_SESSION['manager_id']]);
    
    if ($check_stmt->rowCount() === 0) {
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=activity_not_found");
        exit();
    }

    $activity = $check_stmt->fetch(PDO::FETCH_ASSOC);

    // حذف الصورة إذا وجدت
    if ($activity['image']) {
        $image_path = "../../../../uploads/activities/" . $activity['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // حذف الفعالية
    $delete_sql = "DELETE FROM organization_activities WHERE id = ? AND created_by = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    
    if ($delete_stmt->execute([$activity_id, $_SESSION['manager_id']])) {
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?success=activity_deleted");
    } else {
        header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=delete_failed");
    }
} catch (Exception $e) {
    header("Location: /SPROJECT/frontend/html/manager/activities/activities.php?error=system_error");
}
exit(); 