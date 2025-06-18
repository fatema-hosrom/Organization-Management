<?php
session_start();
require_once __DIR__ . '/../../../backend/php/config.php';
require_once __DIR__ . "/../auth_check.php";

checkManagerAuth();

if (!isset($_GET['id'])) {
    header("Location: ../../../frontend/html/manager/activities/activities.php?error=invalid_id");
    exit();
}

try {
    // جلب بيانات الفعالية المحددة
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
    
    $stmt->execute([$_GET['id'], $_SESSION['manager_id']]);
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$activity) {
        header("Location: ../../../frontend/html/manager/activities/activities.php?error=activity_not_found");
        exit();
    }
} catch(PDOException $e) {
    error_log("Error in get_activity_data.php: " . $e->getMessage());
    header("Location: ../../../frontend/html/manager/activities/activities.php?error=database_error");
    exit();
} 