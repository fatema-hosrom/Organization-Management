<?php
session_start();

// حفظ نوع المستخدم قبل تسجيل الخروج
$user_type = null;
if (isset($_SESSION['supervisor_id'])) {
    $user_type = 'supervisor';
    unset($_SESSION['supervisor_id']);
    unset($_SESSION['supervisor_username']);
    unset($_SESSION['supervisor_full_name']);
    unset($_SESSION['supervisor_role']);
} elseif (isset($_SESSION['manager_id'])) {
    $user_type = 'manager';
    unset($_SESSION['manager_id']);
    unset($_SESSION['manager_username']);
    unset($_SESSION['manager_full_name']);
    unset($_SESSION['manager_role']);
    unset($_SESSION['manager_type']);
}

// توجيه المستخدم إلى صفحة تسجيل الدخول المناسبة
if ($user_type === 'supervisor') {
    header("Location: /SPROJECT/frontend/html/supervisor_login.php");
} elseif ($user_type === 'manager') {
    header("Location: /SPROJECT/frontend/html/manager_login.php");}

exit();
?> 


<!-- session_start();

// حفظ نوع المستخدم قبل تسجيل الخروج
$user_type = null;
if (isset($_SESSION['supervisor_id'])) {
    $user_type = 'supervisor';
} elseif (isset($_SESSION['manager_id'])) {
    $user_type = 'manager';
}

// إزالة جميع بيانات الجلسة
session_unset();
session_destroy();

// توجيه المستخدم إلى صفحة تسجيل الدخول المناسبة
if ($user_type === 'supervisor') {
    header("Location: /SPROJECT/frontend/html/supervisor_login.php");
} elseif ($user_type === 'manager') {
    header("Location: /SPROJECT/frontend/html/manager_login.php");
}
exit(); -->
