<?php
if (!isset($_SESSION['supervisor_id'])) {
    header("Location: /SPROJECT/frontend/html/supervisor_login.php");
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
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/supervisor/dashboard.php">
                <i class="fas fa-home"></i>
                الرئيسية
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/supervisor/profile.php">
                <i class="fas fa-user"></i>
                الملف الشخصي
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manager.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/supervisor/managers.php">
                <i class="fas fa-users"></i>
                إدارة الأعضاء
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'assign_role.php' ? 'active' : ''; ?>" href="/SPROJECT/frontend/html/supervisor/assign_role.php">
                <i class="fas fa-user-tag"></i>
                تحديد أدوار المدراء
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

    /* تعديل المحتوى الرئيسي ليتناسب مع القائمة الجانبية */
    .main-content {
        margin-right: 280px;
        padding: 20px;
    }

    /* تحسين مظهر القائمة */
    .nav {
        padding-top: 10px;
    }

    .nav-item:last-child {
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 15px;
    }

    /* تحسين مظهر الروابط النشطة */
    .nav-link.active i {
        color: white;
    }
</style>