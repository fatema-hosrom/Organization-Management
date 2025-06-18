<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth_check.php';

checkSupervisorAuth();

if (isset($_GET['id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM managers WHERE id = ?");
        if ($stmt->execute([$_GET['id']])) {
            header("Location: ../../../frontend/html/supervisor/managers.php?success=1");
        } else {
            header("Location: ../../../frontend/html/supervisor/managers.php?error=1");
        }
    } catch (PDOException $e) {
        header("Location: ../../../frontend/html/supervisor/managers.php?error=1");
    }
} else {
    header("Location: ../../../frontend/html/supervisor/managers.php");
}
exit(); 