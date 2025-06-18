<?php
require_once __DIR__ . '../../../backend/php/supervisor/login_process.php';

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول المشرف - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/login2.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="../assets/images/logos/logo.png" alt="شعار الجمعية">
            <h1>تسجيل دخول المشرف</h1>
            <p>مرحباً بك في لوحة تحكم المشرف</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/SPROJECT/backend/php/supervisor/login_process.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" name="email" placeholder="البريد الإلكتروني" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                تسجيل الدخول
            </button>
        </form>

        <div class="login-footer">
            <p>هل أنت مدير فعاليات؟ <a href="manager_login.php">تسجيل الدخول كمدير فعاليات</a></p>
            <p><a href="/SPROJECT/backend/php/logout.php">تسجيل الخروج</a></p>
        </div>
    </div>

    <script src="../assets/js/bootstrap.js"></script>
</body>
</html> 