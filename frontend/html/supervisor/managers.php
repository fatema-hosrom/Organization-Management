<?php

require_once __DIR__ . '/../../../backend/php/supervisor/managers_data.php';


?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المدراء - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="../../assets/css/supervisor/managers.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include '../../templates/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h2 class="page-title mb-0">إدارة المدراء</h2>
                    <button class="btn add-btn" onclick="window.location.href='add_manager.php'">
                        <i class="fas fa-plus"></i>
                        إضافة مدير جديد
                    </button>
                </div>
            </div>

            <div class="row">
                <?php foreach ($managers as $manager): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="manager-card">
                            <div class="manager-header">
                                <h4 class="manager-name">
                                    <i class="fas fa-user-circle"></i>
                                    <?php echo htmlspecialchars($manager['full_name']); ?>
                                </h4>
                                <span class="manager-role">
                                    <i class="fas fa-user-tie"></i>
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
                                </span>
                            </div>
                            <div class="manager-info">
                                <i class="fas fa-envelope"></i>
                                <?php echo htmlspecialchars($manager['email']); ?>
                            </div>
                            <div class="manager-info">
                                <i class="fas fa-phone"></i>
                                <?php echo htmlspecialchars($manager['phone']); ?>
                            </div>
                            <div class="manager-info">
                                <i class="fas fa-user"></i>
                                <?php echo htmlspecialchars($manager['username']); ?>
                            </div>
                            <div class="manager-info">
                                <i class="fas fa-clock"></i>
                                <span class="status-badge <?php echo $manager['status'] == 'active' ? 'status-active' : 'status-inactive'; ?>">
                                    <i class="fas <?php echo $manager['status'] == 'active' ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                    <?php echo $manager['status'] == 'active' ? 'مفعل' : 'معطل'; ?>
                                </span>
                            </div>
                            <div class="action-buttons">
                                <button class="btn action-btn view-btn" onclick="window.location.href='view_manager.php?id=<?php echo $manager['id']; ?>'">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </button>
                                <button class="btn action-btn edit-btn" onclick="window.location.href='edit_manager.php?id=<?php echo $manager['id']; ?>'">
                                    <i class="fas fa-edit"></i>
                                    تعديل
                                </button>
                                <!-- <button class="btn action-btn activate-btn" onclick="confirmToggleStatus(<?php echo $manager['id']; ?>)">
                                    <i class="fas fa-power-off"></i>
                                    <?php echo $manager['status'] ? 'تعطيل' : 'تفعيل'; ?>
                                </button>
                                <button class="btn action-btn delete-btn" onclick="confirmDelete(<?php echo $manager['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                    حذف
                                </button> -->

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>






   

</body>

</html>