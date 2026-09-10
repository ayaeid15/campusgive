<?php
session_start();

// بيانات الاتصال بقاعدة البيانات مباشرة
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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($fullname) || empty($email) || empty($password)) {
        $error = 'يرجى إدخال جميع البيانات المطلوبة';
    } elseif ($password !== $confirm_password) {
        $error = 'كلمات المرور غير متطابقة';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'البريد الإلكتروني مُسجل بالفعل';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$fullname, $email, $phone, $hashed_password])) {
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_name'] = $fullname;
                header('Location: /campusgive/index.php');
                exit();
            } else {
                $error = 'حدث خطأ أثناء إنشاء الحساب';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="auth-page-body">

    <div class="auth-container">
        <!-- كارت التسجيل الزجاجي -->
        <div class="auth-card p-4 p-sm-5 rounded-5 shadow-lg border border-white">

            <!-- العودة للرئيسية والشعار -->
            <div class="text-center mb-4">
                <a href="/campusgive/index.php" class="text-decoration-none d-inline-block mb-2">
                    <span class="fw-bold fs-3" style="color: var(--primary-color);">CampusGive <i
                            class="fa-solid fa-graduation-cap"></i></span>
                </a>
                <h5 class="fw-bold text-dark mb-1">إنشاء حساب جديد</h5>
                <p class="text-muted small">انضم لمنصة التكافل والتبادل الطلابي
                    لتشارك وتستفيد من التبرعات الجامعية
                </p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2 small rounded-3">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">الاسم بالكامل</label>
                    <input type="text" name="fullname" class="form-control rounded-pill px-3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">البريد الإلكتروني الجامعي</label>
                    <input type="email" name="email" class="form-control rounded-pill px-3"
                        placeholder="student@univ.edu.eg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">رقم الهاتف (واتساب)</label>
                    <input type="text" name="phone" class="form-control rounded-pill px-3" placeholder="01xxxxxxxxx">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">كلمة المرور</label>
                    <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="••••••••"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">تأكيد كلمة المرور</label>
                    <input type="password" name="confirm_password" class="form-control rounded-pill px-3"
                        placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-campus-primary w-100 rounded-pill py-2 fw-bold mb-3">
                    إنشاء الحساب
                </button>
            </form>

            <div class="text-center">
                <span class="text-muted small">لديك حساب بالفعل؟</span>
                <a href="/campusgive/auth/login.php" class="small fw-bold text-decoration-none ms-1"
                    style="color: var(--primary-color);">تسجيل الدخول</a>
            </div>

            <div class="text-center mt-4">
                <a href="/campusgive/index.php" class="text-muted small text-decoration-none">
                    <i class="fa-solid fa-arrow-right me-1"></i> العودة للصفحة الرئيسية
                </a>
            </div>
        </div>
    </div>

</body>