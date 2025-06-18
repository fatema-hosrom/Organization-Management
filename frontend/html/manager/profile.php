<?php include '../../../backend/php/manager/manager_profile_data.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي - <?php echo htmlspecialchars($manager['full_name']); ?></title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/manager/profile.css">
</head>

<body>
    <?php include '../../templates/navbar_manager.php'; ?>
    <div class="main-content">
        <div class="container">
            <a href="dashboard.php" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                العودة إلى لوحة التحكم
            </a>
            <div class="profile-card">
                <h2 class="profile-title">الملف الشخصي</h2>
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-user"></i>
                                <span>الاسم الكامل</span>
                            </div>
                            <div class="info-value"><?php echo htmlspecialchars($manager['full_name']); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-user-tag"></i>
                                <span>اسم المستخدم</span>
                            </div>
                            <div class="info-value"><?php echo htmlspecialchars($manager['username']); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i>
                                <span>البريد الإلكتروني</span>
                            </div>
                            <div class="info-value"><?php echo htmlspecialchars($manager['email']); ?></div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-phone"></i>
                                <span>رقم الهاتف</span>
                            </div>
                            <div class="info-value"><?php echo htmlspecialchars($manager['phone']); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-calendar-alt"></i>
                                <span>تاريخ الانضمام</span>
                            </div>
                            <div class="info-value"><?php echo date('Y/m/d', strtotime($manager['created_at'])); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-clock"></i>
                                <span>آخر تحديث</span>
                            </div>
                            <div class="info-value"><?php echo date('Y/m/d', strtotime($manager['updated_at'])); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/custom.js"></script>
</body>

</html>