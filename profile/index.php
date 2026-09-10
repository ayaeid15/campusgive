<?php
session_start();
require_once '../includes/db.php'; // تضمين الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// جلب تفاصيل المستخدم باستخدام PDO
$user_query = "SELECT fullname, email, phone FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->execute([$user_id]);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - CampusGive</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/campusgive/assets/css/tasneem_style.css">

    <style>
        body {
            background-color: var(--bg-creamy, #FAF6F3);
            color: var(--text-dark, #140E1C);
            font-family: system-ui, -apple-system, sans-serif;
        }

        .dashboard-card {
            background-color: var(--card-bg, #FDFBF7);
            border: 1px solid rgba(197, 117, 124, 0.25) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(104, 58, 70, 0.08) !important;
        }

        .user-info-card {
            background-color: var(--card-bg, #FDFBF7);
            border: 1px solid rgba(197, 117, 124, 0.3) !important;
            max-width: 600px;
            margin: 0 auto;
        }

        .page-title {
            color: var(--primary-color, #683A46);
        }

        .icon-box {
            background-color: #F3ECE7;
            color: var(--primary-color, #683A46);
            width: 65px;
            height: 65px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
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
    </style>
</head>

<body class="py-5">

    <div class="container py-4">
        <!-- الترحيب بالمستخدم -->
        <div class="text-center mb-4">
            <h2 class="fw-bold page-title mb-2">أهلاً بك في منصة CampusGive 👋</h2>
            <p class="text-muted">اختر من القائمة أدناه ما تريد القيام به اليوم</p>
        </div>

        <!-- بوكس تفاصيل حساب المستخدم -->
        <?php if ($user_info): ?>
            <div class="card user-info-card p-3 p-md-4 rounded-4 shadow-sm mb-5 text-start">
                <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-2">
                    <div class="icon-box" style="width: 50px; height: 50px; flex-shrink: 0;">
                        <i class="fa-solid fa-id-card fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 page-title">بيانات الحساب الشخصي</h5>
                        <small class="text-muted">معلومات الملف الشخصي المسجلة</small>
                    </div>
                </div>
                <div class="row g-2 text-muted small">
                    <div class="col-md-6">
                        <i class="fa-solid fa-user me-2 text-primary"></i>
                        <strong>الاسم:</strong>
                        <?= htmlspecialchars($user_info['fullname']) ?>
                    </div>
                    <div class="col-md-6">
                        <i class="fa-solid fa-envelope me-2 text-warning"></i>
                        <strong>البريد:</strong>
                        <?= htmlspecialchars($user_info['email']) ?>
                    </div>
                    <div class="col-md-6 mt-2">
                        <i class="fa-solid fa-phone me-2 text-success"></i>
                        <strong>الهاتف:</strong>
                        <?= htmlspecialchars($user_info['phone'] ?: 'غير متوفر') ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- شبكة الخيارات / الصفحات -->
        <div class="row g-4 justify-content-center">

            <!-- 1. تصفح جميع التبرعات -->
            <div class="col-md-5 col-lg-4">
                <div class="card dashboard-card h-100 shadow-sm rounded-4 text-center p-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="icon-box mb-3">
                                <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">جميع التبرعات</h5>
                            <p class="card-text text-muted small">استعرض كل العناصر المتاحة، واستخدم الفلاتر والبحث
                                للوصول لما تحتاجه.</p>
                        </div>
                        <a href="/campusgive/donations/all_donations.php"
                            class="btn btn-campus-primary w-100 rounded-pill mt-3 py-2 fw-bold">عرض التبرعات</a>
                    </div>
                </div>
            </div>

            <!-- 2. إضافة تبرع جديد -->
            <div class="col-md-5 col-lg-4">
                <div class="card dashboard-card h-100 shadow-sm rounded-4 text-center p-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="icon-box mb-3">
                                <i class="fa-solid fa-plus-circle fa-xl"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">إضافة تبرع جديد</h5>
                            <p class="card-text text-muted small">انشر مستلزمات أو كتب دراسية ترغب في التبرع بها للطلاب
                                الآخرين.</p>
                        </div>
                        <a href="/campusgive/donations/add.php"
                            class="btn btn-campus-primary w-100 rounded-pill mt-3 py-2 fw-bold">إضافة الآن</a>
                    </div>
                </div>
            </div>

            <!-- 3. طلبات التبرعات الواردة -->
            <div class="col-md-5 col-lg-4">
                <div class="card dashboard-card h-100 shadow-sm rounded-4 text-center p-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="icon-box mb-3">
                                <i class="fa-solid fa-hand-holding-heart fa-xl"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">طلبات التبرعات</h5>
                            <p class="card-text text-muted small">راجع الطلبات المقدمة من الطلاب على العناصر التي تبرعت
                                بها واقبلها أو ارفضها.</p>
                        </div>
                        <a href="../requests/my_requests.php" class="btn ...">مراجعة الطلبات</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>