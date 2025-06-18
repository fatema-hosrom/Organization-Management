<?php

require_once __DIR__ . '/../../../backend/php/supervisor/add_manager_data.php';


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مدير جديد - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="../../assets/css/supervisor/add_manager.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include '../../templates/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <a href="managers.php" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                العودة إلى قائمة المدراء
            </a>

            <div class="form-card">
                <h2 class="form-title">إضافة مدير جديد</h2>

                <?php if (isset($success_message) && $success_message): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($error_message) && $error_message): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-row">
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-user"></i>
                                <label class="form-label">الاسم الكامل</label>
                            </div>
                            <input type="text" class="form-control" name="full_name" required
                                value="<?php echo isset($full_name) ? htmlspecialchars($full_name) : ''; ?>">
                        </div>

                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-user-tag"></i>
                                <label class="form-label">اسم المستخدم</label>
                            </div>
                            <input type="text" class="form-control" name="username" required
                                value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                        </div>

                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-envelope"></i>
                                <label class="form-label">البريد الإلكتروني</label>
                            </div>
                            <input type="email" class="form-control" name="email" required
                                value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-phone"></i>
                                <label class="form-label">رقم الهاتف</label>
                            </div>
                            <input type="tel" class="form-control" name="phone" required
                                value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                        </div>

                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-key"></i>
                                <label class="form-label">كلمة المرور</label>
                            </div>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-user-shield"></i>
                                <label class="form-label">نوع المدير</label>
                            </div>
                            <select class="form-control" name="manager_type" required>
                                <option value="">اختر نوع المدير</option>
                                <option value="financial" <?php echo (isset($manager_type) && $manager_type == 'financial') ? 'selected' : ''; ?>>
                                    مدير مالي
                                </option>
                                <option value="activities" <?php echo (isset($manager_type) && $manager_type == 'activities') ? 'selected' : ''; ?>>
                                    مدير أنشطة
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-plus"></i>
                            إضافة المدير
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/custom.js"></script>
</body>

</html>