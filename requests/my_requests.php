<?php
session_start();
$host = 'localhost';
$dbname = 'campusgive_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}

// التأكد من تسجيل الدخول (لو عندك متغير السيشن بيختلف ظبطيه هنا)
$user_id = $_SESSION['user_id'] ?? 1;

// جلب تبرعات المستخدم الحالي فقط
$stmt = $pdo->prepare("SELECT * FROM donations WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$my_donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طلبات التبرعات الخاصة بي - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #fcf9f5;
            font-family: 'Cairo', sans-serif;
        }

        .navbar-brand {
            color: #5c4033;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-custom {
            background-color: #5c4033;
            color: white;
            border-radius: 50px;
        }

        .btn-custom:hover {
            background-color: #432e24;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>طلبات التبرعات الخاصة بي</h2>
            <a href="../profile/index.php" class="btn btn-outline-secondary rounded-pill px-4">العودة للبروفايل</a>
        </div>

        <?php if (empty($my_donations)): ?>
            <div class="alert alert-warning text-center py-4 rounded-4">
                لا توجد طلبات تبرع مسجلة باسمك حتى الآن.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($my_donations as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card p-3">
                            <h5 class="fw-bold mb-2">
                                <?= htmlspecialchars($item['title'] ?? 'تبرع بدون عنوان') ?>
                            </h5>
                            <p class="text-muted small mb-2">
                                <?= htmlspecialchars($item['description'] ?? '') ?>
                            </p>
                            <p class="mb-3"><strong>المكان:</strong>
                                <?= htmlspecialchars($item['location'] ?? 'غير محدد') ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary px-3 py-2">قيد المراجعة</span>
                                <a href="item_details.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-custom px-3">عرض
                                    التفاصيل</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>