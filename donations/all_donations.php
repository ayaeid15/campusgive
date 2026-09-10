<?php
session_start();
require_once '../includes/db.php';

// معرف المستخدم الحالي إن كان مسجلاً دخول
$current_user_id = $_SESSION['user_id'] ?? 0;

$search = trim($_GET['search'] ?? '');
$location = trim($_GET['location'] ?? '');
$sort = $_GET['sort'] ?? 'latest';

// استعلام التبرعات: يراعي عرض المعلقة (pending) الخاصة بالمستخدم الحالي فقط
$query = "SELECT * FROM donations 
          WHERE (status IN ('approved', 'reserved', 'completed') OR (status = 'pending' AND user_id = ?))";

$params = [$current_user_id];

if ($search !== '') {
    $query .= " AND (title LIKE ? OR description LIKE ?)";
    $searchParam = "%$search%";
    $params[] = $searchParam;
    $params[] = $searchParam;
}

if ($location !== '') {
    $query .= " AND (location LIKE ? OR college_name LIKE ?)";
    $locationParam = "%$location%";
    $params[] = $locationParam;
    $params[] = $locationParam;
}

if ($sort === 'oldest') {
    $query .= " ORDER BY created_at ASC";
} else {
    $query .= " ORDER BY created_at DESC";
}

// تنفيذ الاستعلام بـ PDO
$stmt = $conn->prepare($query);
$stmt->execute($params);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جميع التبرعات - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- ربط ملف الـ CSS الخارجي -->
    <link rel="stylesheet" href="../assets/css/tasneem_style.css">

    <style>
        body {
            background-color: var(--bg-creamy, #FAF6F3);
            color: var(--text-dark, #140E1C);
            font-family: system-ui, -apple-system, sans-serif;
        }

        .page-title {
            color: var(--primary-color, #683A46);
        }

        /* تنسيق كروت التبرعات */
        .donation-card {
            background-color: var(--card-bg, #FDFBF7);
            border: 1px solid rgba(197, 117, 124, 0.25) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .donation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(104, 58, 70, 0.12) !important;
        }

        /* كادر الصورة */
        .card-img-wrapper {
            height: 200px;
            background-color: #F3ECE7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted, #6C5F63);
        }

        /* أزرار الهوية */
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

        .btn-campus-outline {
            border: 1.5px solid var(--primary-color, #683A46);
            color: var(--primary-color, #683A46);
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-campus-outline:hover {
            background-color: var(--primary-color, #683A46);
            color: #ffffff;
        }

        /* حقول الإدخال عند التركيز */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color, #C5757C);
            box-shadow: 0 0 0 0.25rem rgba(197, 117, 124, 0.25);
        }
    </style>
</head>

<body class="py-5">

    <div class="container">
        <!-- الهيدر والعنوان -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h3 class="fw-bold page-title mb-1">صفحة التبرعات الشاملة</h3>
                <p class="text-muted small mb-0">استعرض وفتش عن العناصر المتاحة للتبرع</p>
            </div>
            <div class="d-flex gap-2">
                <a href="add.php" class="btn btn-campus-primary px-4 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> إضافة تبرع جديد
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="../profile/index.php"
                        class="btn btn-campus-outline btn-sm px-3 rounded-pill d-flex align-items-center">
                        <i class="fa-regular fa-user me-1"></i> حسابي
                    </a>
                <?php else: ?>
                    <a href="../auth/login.php"
                        class="btn btn-campus-outline btn-sm px-3 rounded-pill d-flex align-items-center">
                        <i class="fa-regular fa-right-to-bracket me-1"></i> تسجيل الدخول
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- نموذج الفلترة والبحث -->
        <div class="card p-4 mb-5 border-0 rounded-4 shadow-sm" style="background-color: var(--card-bg, #FDFBF7);">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control rounded-pill px-3"
                            placeholder="بحث بالاسم أو الوصف..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control rounded-pill px-3"
                            placeholder="تصفية بالكلية أو المكان..." value="<?= htmlspecialchars($location) ?>">
                    </div>
                    <div class="col-md-3">
                        <select name="sort" class="form-select rounded-pill px-3">
                            <option value="latest" <?= $sort === 'latest' ? 'selected' : '' ?>>الأحدث أولاً</option>
                            <option value="oldest" <?= $sort === 'oldest' ? 'selected' : '' ?>>الأقدم أولاً</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-campus-primary w-100 rounded-pill fw-bold">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> فلترة
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- شبكة عرض التبرعات -->
        <div class="row g-4">
            <?php if (empty($items)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-box-open fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted fs-5">لا توجد تبرعات متاحة تطابق خيارات البحث.</p>
                </div>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <?php
                    $imagePath = $item['image'] ?? $item['image_url'] ?? null;
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card donation-card h-100 rounded-4 overflow-hidden border-0 shadow-sm position-relative">

                            <!-- شارة توضح إذا كان التبرع قيد المراجعة للناشر -->
                            <?php if (isset($item['status']) && $item['status'] === 'pending'): ?>
                                <span
                                    class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark px-3 py-2 rounded-pill">قيد
                                    المراجعة</span>
                            <?php endif; ?>

                            <!-- الصورة -->

                            <!-- الصورة -->
                            <?php if (!empty($item['image'])): ?>
                                <img src="../assets/images/<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top"
                                    style="height: 200px; width: 100%; object-fit: contain; background-color: #F3ECE7;"
                                    alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <?php else: ?>
                                <div class="card-img-wrapper text-center py-4 bg-light">
                                    <i class="fa-solid fa-image fs-2 mb-1 opacity-50"></i>
                                    <span class="d-block small text-muted">لا توجد صورة</span>
                                </div>
                            <?php endif; ?>
                            <!-- المحتوى -->
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark mb-2 text-truncate">
                                        <?= htmlspecialchars($item['title'] ?? '') ?>
                                    </h5>
                                    <p class="card-text text-muted small text-truncate mb-3">
                                        <?= htmlspecialchars($item['description'] ?? '') ?>
                                    </p>

                                    <div class="small text-muted mb-3">
                                        <i class="fa-solid fa-location-dot me-1 text-danger"></i>
                                        <?= htmlspecialchars($item['location'] ?? $item['college_name'] ?? 'غير محدد') ?>
                                    </div>
                                </div>

                                <a href="details.php?id=<?= $item['id'] ?>"
                                    class="btn btn-campus-outline w-100 rounded-pill fw-bold py-2 mt-2">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>