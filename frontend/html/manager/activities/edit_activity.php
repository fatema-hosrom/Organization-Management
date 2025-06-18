<?php
require_once "../../../../backend/php/manager/edit_activity_data.php";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الفعالية - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../../assets/css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/activities/edit_activity.css">
</head>

<body>
    <?php include '../../../templates/navbar_manager.php'; ?>
    <div class="main-content">
        <div class="container">
            <a href="activities.php" class="back-btn">
                <i class="fas fa-arrow-right"></i>
                العودة إلى قائمة الفعاليات
            </a>
            <div class="form-card">
                <h2 class="form-title">تعديل الفعالية</h2>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data" action="../../../../backend/php/manager/edit_activity_data.php">
                    <input type="hidden" name="id" value="<?php echo $activity['id']; ?>">
                    <div class="form-row">
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-heading"></i>
                                <label class="form-label">عنوان الفعالية</label>
                            </div>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($activity['title']); ?>" required>
                        </div>
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-tag"></i>
                                <label class="form-label">نوع الفعالية</label>
                            </div>
                            <select class="form-control" name="activity_type" required>
                                <option value="regular" <?php echo $activity['activity_type'] == 'regular' ? 'selected' : ''; ?>>عادية</option>
                                <option value="donation" <?php echo $activity['activity_type'] == 'donation' ? 'selected' : ''; ?>>تبرع</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-calendar-day"></i>
                                <label class="form-label">تاريخ البداية</label>
                            </div>
                            <input type="datetime-local" class="form-control" name="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($activity['start_date'])); ?>" required>
                        </div>
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-calendar-check"></i>
                                <label class="form-label">تاريخ النهاية</label>
                            </div>
                            <input type="datetime-local" class="form-control" name="end_date" value="<?php echo date('Y-m-d\TH:i', strtotime($activity['end_date'])); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-map-marker-alt"></i>
                                <label class="form-label">الموقع</label>
                            </div>
                            <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($activity['location']); ?>" required>
                        </div>
                        <div class="input-container">
                            <div class="input-group-label">
                                <i class="fas fa-users"></i>
                                <label class="form-label">عدد المتطوعين المطلوب</label>
                            </div>
                            <input type="number" class="form-control" name="required_volunteers" min="0" value="<?php echo $activity['required_volunteers']; ?>">
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save"></i>
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../../assets/js/bootstrap.js"></script>
    <script src="../../../assets/js/custom.js"></script>
</body>

</html>
