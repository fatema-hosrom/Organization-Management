<?php

require_once __DIR__ . '/../../../backend/php/supervisor/dashboard_data.php';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="../../assets/css/supervisor/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include '../../templates/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-number"><?php echo $managers_count; ?></div>
                        <div class="stats-label">عدد المدراء</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="recent-card">
                        <div class="recent-header">
                            <h5 class="recent-title">آخر المدراء المسجلين</h5>
                        </div>
                        <?php foreach ($recent_managers as $manager): ?>
                            <div class="manager-item">
                                <div class="manager-avatar">
                                    <?php echo strtoupper(substr($manager['full_name'], 0, 1)); ?>
                                </div>
                                <div class="manager-info">
                                    <h6 class="manager-name"><?php echo htmlspecialchars($manager['full_name']); ?></h6>
                                    <div class="manager-role"><?php echo htmlspecialchars($manager['manager_type']); ?></div>
                                </div>
                                <div class="manager-date">
                                    <?php echo date('Y-m-d', strtotime($manager['created_at'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/custom.js"></script>
</body>

</html>