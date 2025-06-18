<?php
// ملف عمليات الفعاليات: إضافة، تعديل، حذف، عرض
// Author: AI Assistant

session_start();
require_once __DIR__ . '/../config.php';

// تحقق من صلاحية المستخدم
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'manager' || !isset($_SESSION['manager_type']) || $_SESSION['manager_type'] !== 'activities') {
    http_response_code(401);
    echo json_encode(['error' => 'unauthorized']);
    exit();
}

// دالة لجلب جميع الفعاليات الخاصة بالمستخدم
function get_activities($conn, $user_id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM organization_activities WHERE created_by = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

// دالة لجلب فعالية واحدة
function get_activity($conn, $id, $user_id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM organization_activities WHERE id = ? AND created_by = ?");
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}

// دالة لإضافة فعالية جديدة
function add_activity($conn, $data, $user_id) {
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
            $data['title'],
            $data['description'],
            $data['activity_type'],
            $data['start_date'],
            $data['end_date'],
            $data['location'],
            $data['required_volunteers'],
            $image_name,
            $user_id
        ]);
        return ['success' => 'تمت إضافة الفعالية بنجاح'];
    } catch (PDOException $e) {
        return ['error' => 'حدث خطأ في قاعدة البيانات: ' . $e->getMessage()];
    }
}

// دالة لتعديل فعالية
function edit_activity($conn, $id, $data, $user_id) {
    $activity = get_activity($conn, $id, $user_id);
    if (!$activity) return ['error' => 'الفعالية غير موجودة'];
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
            $data['title'],
            $data['description'],
            $data['activity_type'],
            $data['start_date'],
            $data['end_date'],
            $data['location'],
            $data['required_volunteers'],
            $image_name,
            $id,
            $user_id
        ]);
        return ['success' => 'تم تحديث الفعالية بنجاح'];
    } catch (PDOException $e) {
        return ['error' => 'حدث خطأ في قاعدة البيانات: ' . $e->getMessage()];
    }
}

// دالة لحذف فعالية
function delete_activity($conn, $id, $user_id) {
    try {
        $stmt = $conn->prepare("DELETE FROM organization_activities WHERE id = ? AND created_by = ?");
        $stmt->execute([$id, $user_id]);
        return ['success' => 'تم حذف الفعالية بنجاح'];
    } catch (PDOException $e) {
        return ['error' => 'حدث خطأ في قاعدة البيانات: ' . $e->getMessage()];
    }
}

// معالجة الطلبات حسب نوع العملية
$action = $_GET['action'] ?? $_POST['action'] ?? '';
switch ($action) {
    case 'list':
        $activities = get_activities($conn, $_SESSION['user_id']);
        echo json_encode(['activities' => $activities]);
        break;
    case 'get':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $activity = get_activity($conn, $id, $_SESSION['user_id']);
            echo json_encode(['activity' => $activity]);
        } else {
            echo json_encode(['error' => 'معرف الفعالية مفقود']);
        }
        break;
    case 'add':
        $data = $_POST;
        $result = add_activity($conn, $data, $_SESSION['user_id']);
        echo json_encode($result);
        break;
    case 'edit':
        $id = $_POST['id'] ?? null;
        $data = $_POST;
        if ($id) {
            $result = edit_activity($conn, $id, $data, $_SESSION['user_id']);
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'معرف الفعالية مفقود']);
        }
        break;
    case 'delete':
        $id = $_POST['id'] ?? null;
        if ($id) {
            $result = delete_activity($conn, $id, $_SESSION['user_id']);
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'معرف الفعالية مفقود']);
        }
        break;
    default:
        echo json_encode(['error' => 'عملية غير معروفة']);
} 