<?php include '../../../backend/php/manager/dashboard_data.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم مدير الفعاليات</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/manager/dashboard.css">
</head>

<body>
    <?php include '../../templates/navbar_manager.php'; ?>
    <div class="main-content">
        <div class="container">
            <h2 class="mb-4">مرحباً، <?php echo htmlspecialchars($manager['full_name']); ?> 👋</h2>
            <div class="row dashboard-actions">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <div class="stats-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stats-number"><?php echo $activities_count; ?></div>
                        <div class="stats-label">عدد الفعاليات</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="recent-card">
                        <div class="recent-header">
                            <h5 class="recent-title">آخر الفعاليات المضافة</h5>
                        </div>
                        <?php if ($recent_activities): foreach ($recent_activities as $activity): ?>
                            <div class="activity-item">
                                <div class="activity-img">
                                    <?php if ($activity['image']): ?>
                                        <img src="../../../uploads/activities/<?php echo htmlspecialchars($activity['image']); ?>" alt="صورة الفعالية" style="width:100%;height:100%;border-radius:8px;object-fit:cover;">
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:1.5rem;">لا يوجد</span>
                                    <?php endif; ?>
                                </div>
                                <div class="activity-info">
                                    <h6 class="activity-title"><?php echo htmlspecialchars($activity['title']); ?></h6>
                                    <div class="activity-type"><?php echo $activity['activity_type'] === 'regular' ? 'عادية' : 'تبرع'; ?></div>
                                </div>
                                <div class="activity-date">
                                    <?php echo htmlspecialchars($activity['start_date']); ?>
                                </div>
                            </div>
                        <?php endforeach; else: ?>
                            <div class="text-center text-muted">لا توجد فعاليات حديثة.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="alert alert-info mt-4">
                يمكنك إدارة جميع فعالياتك من خلال لوحة التحكم هذه.
            </div>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/custom.js"></script>
</body>

</html>