<?php
require_once "../../../../backend/php/manager/activities_data.php";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة فعاليات المؤسسة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/activities/activities.css">
</head>

<body>
    <?php include '../../../templates/navbar_manager.php'; ?>
    <div class="main-content">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h2 class="page-title mb-0">قائمة فعاليات المؤسسة</h2>
                    <button class="btn add-btn" onclick="window.location.href='add_activity.php'">
                        <i class="fas fa-plus"></i>
                        إضافة فعالية
                    </button>
                </div>
            </div>
            <?php if (isset($_GET['success'])): ?>
                <div id="successMessage" style="text-align: center; margin-bottom: 20px;">
                    <span style="color: #28a745; font-size: 30px;">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php
                        switch ($_GET['success']) {
                            case 'activity_deleted':
                                echo 'تم حذف الفعالية بنجاح';
                                break;
                            default:
                                echo htmlspecialchars($_GET['success']);
                        }
                        ?>
                    </span>
                </div>
                <script>
                    setTimeout(function() {
                        var successMessage = document.getElementById('successMessage');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 7000);
                </script>
            <?php endif; ?>
            
            <div class="row">
                <?php if (!empty($activities)): foreach ($activities as $activity): ?>
                    <div class="col-12 mb-4">
                        <div class="activity-card">
                            <div class="activity-header">
                                <h4 class="activity-title">
                                    <span class="activity-img">
                                        <?php if ($activity['image']): ?>
                                            <img src="../../../../uploads/activities/<?php echo htmlspecialchars($activity['image']); ?>" alt="صورة الفعالية" style="width:100%;height:100%;border-radius:8px;object-fit:cover;">
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:1.5rem;">لا يوجد</span>
                                        <?php endif; ?>
                                    </span>
                                    <?php echo htmlspecialchars($activity['title']); ?>
                                </h4>
                                <span class="activity-type">
                                    <i class="fas fa-tag"></i>
                                    <?php echo $activity['activity_type'] === 'regular' ? 'عادية' : 'تبرع'; ?>
                                </span>
                            </div>
                            <div class="activity-info">
                                <i class="fas fa-calendar-day"></i>
                                <span>تاريخ البداية: <?php echo htmlspecialchars($activity['start_date']); ?></span>
                            </div>
                            <div class="activity-info">
                                <i class="fas fa-calendar-check"></i>
                                <span>تاريخ النهاية: <?php echo htmlspecialchars($activity['end_date']); ?></span>
                            </div>
                            <div class="activity-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>الموقع: <?php echo htmlspecialchars($activity['location']); ?></span>
                            </div>
                            <div class="activity-info">
                                <i class="fas fa-users"></i>
                                <span>المتطوعين المطلوبين: <?php echo htmlspecialchars($activity['required_volunteers']); ?></span>
                            </div>
                            <div class="action-buttons">
                                <button class="btn action-btn edit-btn" onclick="window.location.href='edit_activity.php?id=<?php echo $activity['id']; ?>'">
                                    <i class="fas fa-edit"></i>
                                    تعديل
                                </button>
                                <button class="btn action-btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $activity['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- نافذة التأكيد -->
                    <div class="modal fade" id="deleteModal<?php echo $activity['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin:0;"></button>
                                    <h5 class="modal-title" style="margin: auto;" >تأكيد الحذف</h5>
                                   
                                </div>
                                <div class="modal-body">
                                    هل أنت متأكد من حذف الفعالية "<?php echo htmlspecialchars($activity['title']); ?>"؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                    <a href="../../../../backend/php/manager/delete_activity_data.php?id=<?php echo $activity['id']; ?>" class="btn btn-danger">حذف</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                else: ?>
                    <div class="col-12 text-center text-muted">
                        <i class="fas fa-info-circle mb-2" style="font-size: 2rem;"></i>
                        <p>لا توجد فعاليات حالياً.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- تحميل مكتبات JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/custom.js"></script>
</body>
</html>