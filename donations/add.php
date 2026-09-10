<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $college_name = trim($_POST['college_name'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $category = trim($_POST['category'] ?? 'كتب ومراجع');
    $user_id = $_SESSION['user_id'];
    $image_path = null;

    // معالجة الصورة في حال تم رفعها فقط (اختياري)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {
            $newName = 'item_' . time() . '_' . uniqid() . '.' . $ext;
            $targetDir = '../uploads/';

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $newName)) {
                $image_path = 'uploads/' . $newName;
            }
        } else {
            $error = "عذراً، نوع الملف غير مدعوم (المسموح: JPG, PNG, WEBP).";
        }
    }

    // الحفظ في قاعدة البيانات باستخدام PDO
    if (empty($error)) {
        if (!empty($title) && !empty($description)) {
            try {
                $stmt = $conn->prepare("
                    INSERT INTO donations (user_id, title, category, college_name, location, description, image, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())
                ");

                $stmt->execute([$user_id, $title, $category, $college_name, $location, $description, $image_path]);
                $message = "تم إضافة التبرع بنجاح! وهو الآن قيد المراجعة.";
            } catch (PDOException $e) {
                $error = "خطأ في حفظ البيانات: " . $e->getMessage();
            }
        } else {
            $error = "يرجى ملء الحقول المطلوبة الأساسية.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة تبرع جديد - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/tasneem_style.css">

    <style>
        body {
            background-color: var(--bg-creamy, #FAF6F3);
            color: var(--text-dark, #140E1C);
            font-family: system-ui, -apple-system, sans-serif;
        }

        .auth-card {
            background-color: var(--card-bg, #FDFBF7);
            border: 1px solid rgba(197, 117, 124, 0.25) !important;
        }

        .page-title {
            color: var(--primary-color, #683A46);
        }

        .btn-campus-primary {
            background-color: var(--primary-color, #683A46);
            color: #ffffff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-campus-primary:hover {
            background-color: var(--secondary-color, #A1525F);
            color: #ffffff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color, #C5757C);
            box-shadow: 0 0 0 0.25rem rgba(197, 117, 124, 0.25);
        }
    </style>
</head>

<body class="py-5">

    <div class="container col-md-7 col-lg-6">
        <div class="card auth-card p-4 p-md-5 shadow-sm rounded-4">

            <div class="text-center mb-4">
                <h4 class="fw-bold page-title mb-1">إضافة تبرع جديد</h4>
                <p class="text-muted small">شارك الكتب والأدوات الدراسية مع زملائك في الجامعة</p>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-success py-2 small rounded-3 text-center">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger py-2 small rounded-3 text-center">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">عنوان التبرع / اسم المنتج <span
                            class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill px-3" required
                        placeholder="مثال: كتاب الخوارزميات">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">التصنيف <span
                            class="text-danger">*</span></label>
                    <select name="category" class="form-select rounded-pill px-3" required>
                        <option value="كتب ومراجع">كتب ومراجع</option>
                        <option value="أدوات هندسية">أدوات هندسية</option>
                        <option value="أجهزة وإلكترونيات">أجهزة وإلكترونيات</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">وصف المنتج <span
                            class="text-danger">*</span></label>
                    <textarea name="description" class="form-control rounded-4 p-3" rows="3" required
                        placeholder="تفاصيل المنتج أو حالته..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-muted">اسم الكلية<span
                                class="text-danger">*</span></label>
                        <input type="text" name="college_name" class="form-control rounded-pill px-3" required
                            placeholder="مثال: الحاسبات والمعلومات">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-muted">مكان الاستلام / المقر<span
                                class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control rounded-pill px-3" required
                            placeholder="مثال: المبنى الرئيسي">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">صورة المنتج <span
                            class="text-muted fw-normal">(اختياري)</span></label>
                    <input type="file" name="image" class="form-control rounded-pill px-3" accept="image/*">
                </div>

                <button type="submit" class="btn btn-campus-primary w-100 py-2.5 rounded-pill fw-bold mb-3">
                    <i class="fa-solid fa-plus me-1"></i> نشر التبرع
                </button>

                <div class="text-center">
                    <a href="all_donations.php" class="text-decoration-none small text-muted">
                        <i class="fa-solid fa-arrow-right me-1"></i> العودة لقائمة التبرعات
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>