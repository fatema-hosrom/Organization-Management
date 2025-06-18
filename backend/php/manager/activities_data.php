<?php
session_start();
require_once __DIR__ . '/../../../backend/php/config.php';  
require_once __DIR__ . '/../../../backend/php/auth_check.php';

checkManagerAuth();



try {
    // جلب جميع الفعاليات التي أنشأها المدير
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
        WHERE created_by = ? 
        ORDER BY created_at DESC
    ");
    
    $stmt->execute([$_SESSION['manager_id']]);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error in activities_data.php: " . $e->getMessage());
    $activities = [];
}

// لا نقوم بطباعة البيانات كـ JSON
// echo json_encode(['activities' => $activities]); 