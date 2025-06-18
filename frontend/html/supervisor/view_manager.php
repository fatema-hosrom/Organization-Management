<?php

require_once __DIR__ . '/../../../backend/php/supervisor/view_manager_data.php';


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معلومات المدير - <?php echo htmlspecialchars($manager['full_name']); ?></title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="../../assets/css/supervisor/view_manager.css">
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

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="profile-card">
                        <div class="profile-header">
                      
                            <h2 class="profile-name"><?php echo htmlspecialchars($manager['full_name']); ?></h2>
                            <div class="profile-role">  <span class="status-badge <?php echo $manager['status'] == 'active' ? 'status-active' : 'status-inactive'; ?>">
                                    <i class="fas <?php echo $manager['status'] == 'active' ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                    <?php echo $manager['status'] == 'active' ? 'مفعل' : 'معطل'; ?>
                                </span></div>
                        </div>

                        <div class="info-section">
                            <h3 class="info-title">المعلومات الشخصية</h3>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="info-label">البريد الإلكتروني</div>
                                    <div class="info-value"><?php echo htmlspecialchars($manager['email']); ?></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <div class="info-label">رقم الهاتف</div>
                                    <div class="info-value"><?php echo htmlspecialchars($manager['phone']); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3 class="info-title">معلومات الحساب</h3>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="info-label">اسم المستخدم</div>
                                    <div class="info-value"><?php echo htmlspecialchars($manager['username']); ?></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div>
                                    <div class="info-label">الدور</div>
                                    <div class="info-value"> <span class="manager-role">
                                   
                                    <?php
                                    $role_name = '';
                                    switch ($manager['manager_type']) {
                                        case 'financial':
                                            $role_name = 'مدير مالي';
                                            break;
                                        case 'activities':
                                            $role_name = 'مدير أنشطة';
                                            break;
                                        default:
                                            $role_name = 'غير محدد';
                                    }
                                    echo $role_name;
                                    ?>
                                </span></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div>
                                    <div class="info-label">تاريخ التسجيل</div>
                                    <div class="info-value"><?php echo date('Y-m-d', strtotime($manager['created_at'])); ?></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <div class="info-label">الحالة</div>
                                    <div class="info-value">
                                    <span class="status-badge <?php echo $manager['status'] == 'active' ? 'status-active' : 'status-inactive'; ?>">
                                    <i class="fas <?php echo $manager['status'] == 'active' ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                    <?php echo $manager['status'] == 'active' ? 'مفعل' : 'معطل'; ?>
                                </span>
                                    </div>
                                </div>
                            </div>
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