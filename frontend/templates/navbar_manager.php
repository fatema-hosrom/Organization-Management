<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['manager_id'])) {
    header("Location: /SPROJECT/frontend/html/manager_login.php");
    exit();
}
?>
<div class="sidebar">
    <div class="sidebar-header">
        <img src="/SPROJECT/frontend/assets/images/logos/logo.png" alt="شعار الجمعية">
        <h4>نظام إدارة الجمعيات</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/manager/dashboard.php">
                <i class="fas fa-home"></i>
                الرئيسية
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/manager/profile.php">
                <i class="fas fa-user"></i>
                الملف الشخصي
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'activities.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/manager/activities/activities.php">
                <i class="fas fa-calendar-alt"></i>
                الفعاليات
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/SPROJECT/backend/php/logout.php">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </a>
        </li>
    </ul>
</div>
<!-- نفس تنسيقات ناف بار المشرف -->
<link rel="stylesheet" href="../../assets/css/bootstrap.css">
<style>
    .sidebar {
        position: fixed;
        right: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: #2c3e50;
        color: white;
        padding-top: 20px;
        z-index: 1000;
    }

    .sidebar-header {
        text-align: center;
        padding: 20px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }

    .sidebar-header h4 {
        color: white;
        margin: 0;
        font-size: 1.2rem;
        font-weight: 500;
    }

    .nav-item {
        margin: 5px 15px;
    }

    .nav-link {
        color: #ecf0f1 !important;
        padding: 12px 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        transition: all 0.3s;
    }

    .nav-link i {
        margin-left: 10px;
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white !important;
    }

    .nav-link.active {
        background: #3498db;
        color: white !important;
    }

    .main-content {
        margin-right: 280px;
        padding: 20px;
    }

    .nav {
        padding-top: 10px;
    }

    .nav-item:last-child {
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 15px;
    }

    .nav-link.active i {
        color: white;
    }
</style>