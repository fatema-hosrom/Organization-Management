<?php

require_once __DIR__ . '/../../../backend/php/supervisor/assign_role_data.php';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديد أدوار المدراء - نظام إدارة الجمعيات</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="../../assets/css/supervisor/assign_role.css">
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
                    <div class="form-card">
                        <h2 class="form-title">تحديد أدوار المدراء</h2>

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

                        <form method="POST" action="" id="assignRoleForm">
                            <div class="form-group">
                                <div class="input-group-label">
                                    <i class="fas fa-user-tie"></i>
                                    <label class="form-label">اختر المدير</label>
                                </div>
                                <select class="form-control" name="manager_id" id="manager_id" required>
                                    <option value="">اختر المدير</option>
                                    <?php foreach ($managers as $manager): ?>
                                        <option value="<?php echo $manager['id']; ?>"
                                            <?php echo isset($_POST['manager_id']) && $_POST['manager_id'] == $manager['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($manager['full_name']); ?>
                                            (<?php
                                                switch ($manager['manager_type']) {
                                                    case 'financial':
                                                        echo 'مدير مالي';
                                                        break;
                                                    case 'activities':
                                                        echo 'مدير فعاليات';
                                                        break;
                                                    default:
                                                        echo 'غير محدد';
                                                }
                                                ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="input-group-label">
                                    <i class="fas fa-user-shield"></i>
                                    <label class="form-label">نوع المدير</label>
                                </div>
                                <select class="form-control" name="manager_type" id="manager_type" required>
                                    <option value="">اختر نوع المدير</option>
                                    <option value="financial" <?php echo isset($_POST['manager_type']) && $_POST['manager_type'] == 'financial' ? 'selected' : ''; ?>>
                                        مدير مالي
                                    </option>
                                    <option value="activities" <?php echo isset($_POST['manager_type']) && $_POST['manager_type'] == 'activities' ? 'selected' : ''; ?>>
                                        مدير فعاليات
                                    </option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save"></i>
                                    حفظ التغييرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal تأكيد التعديل -->
    <div class="modal fade confirmation-modal" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد تحديث الدور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من تحديث دور المدير؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">تأكيد</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script>
        function confirmSubmit() {
            if (!document.getElementById('manager_id').value || !document.getElementById('manager_type').value) {
                alert('الرجاء اختيار المدير ونوع المدير');
                return;
            }
            var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
        }

        function submitForm() {
            document.getElementById('assignRoleForm').submit();
        }
    </script>
</body>

</html>