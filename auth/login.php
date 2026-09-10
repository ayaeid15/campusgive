<?php
session_start();
require_once '../includes/db.php';

$error = '';

// التأكد من أن الإرسال تم عبر دالة POST (عند الضغط على زر الدخول فقط)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($email) && !empty($password)) {
        try {
            // تحضير الاستعلام بـ PDO بدلاً من MySQLi
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // التحقق من وجود المستخدم وصحة كلمة المرور (يدعم التشفير أو النص العادي)
            if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];

                // التوجيه حسب نوع المستخدم
                if ($user['role'] === 'admin') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
            }
        } catch (PDOException $e) {
            $error = "حدث خطأ أثناء الاتصال بقاعدة البيانات";
        }
    } else {
        $error = "يرجى إدخال جميع البيانات المطلوبة";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="auth-page-body">

    <div class="auth-container">
        <!-- كارت تسجيل الدخول الزجاجي -->
        <div class="auth-card p-4 p-sm-5 rounded-5 shadow-lg border border-white">

            <!-- العودة للرئيسية والشعار -->
            <div class="text-center mb-4">
                <a href="/campusgive/index.php" class="text-decoration-none d-inline-block mb-2">
                    <span class="fw-bold fs-3" style="color: var(--primary-color);">CampusGive <i
                            class="fa-solid fa-graduation-cap"></i></span>
                </a>
                <h5 class="fw-bold text-dark mb-1">تسجيل الدخول</h5>
                <p class="text-muted small">أدخل بياناتك للمتابعة في منصة CampusGive</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2 small rounded-3 text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control rounded-pill px-3"
                        placeholder="example@univ.edu.eg" required
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">كلمة المرور</label>
                    <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="••••••••"
                        required>
                </div>

                <button type="submit" class="btn btn-campus-primary w-100 rounded-pill py-2 fw-bold mb-3">
                    دخول
                </button>
            </form>

            <div class="text-center">
                <span class="text-muted small">ليس لديك حساب؟</span>
                <a href="/campusgive/auth/register.php" class="small fw-bold text-decoration-none ms-1"
                    style="color: var(--primary-color);">حساب جديد</a>
            </div>

            <div class="text-center mt-4">
                <a href="/campusgive/index.php" class="text-muted small text-decoration-none">
                    <i class="fa-solid fa-arrow-right me-1"></i> العودة للصفحة الرئيسية
                </a>
            </div>
        </div>
    </div>

</body>

</html>