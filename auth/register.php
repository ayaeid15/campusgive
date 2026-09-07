<?php 
session_start();
include '../includes/db.php';
include '../includes/header.php'; 
include '../includes/navbar.php'; 

$message = "";
$msg_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname         = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email            = mysqli_real_escape_string($conn, $_POST['email']);
    $phone            = mysqli_real_escape_string($conn, $_POST['phone']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "كلمات المرور غير متطابقة!";
        $msg_type = "danger";
    } else {
        // التحقق من وجود البريد سابقاً
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $message = "البريد الإلكتروني مسجل بالفعل!";
            $msg_type = "warning";
        } else {
            // تشفير كلمة المرور وحفظ المستخدم
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (fullname, email, phone, password) VALUES ('$fullname', '$email', '$phone', '$hashed_password')";
            
            if (mysqli_query($conn, $query)) {
                $new_user_id = mysqli_insert_id($conn);
                
                $_SESSION['user_id']   = $new_user_id;
                $_SESSION['user_name'] = $fullname;
                $_SESSION['user_role'] = 'user';

                $_SESSION['welcome_message'] = "أهلاً بك يا " . htmlspecialchars($fullname) . " في عائلة CampusGive! 🎓✨ يسعدنا انضمامك لتسهم في نشر الخير وتيسير الرحلة الدراسية على زملائك.";

                header("Location: ../donations/browse.php");
                exit();
            } else {
                $message = "حدث خطأ أثناء التسجيل: " . mysqli_error($conn);
                $msg_type = "danger";
            }
        }
    }
}
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">إنشاء حساب جديد</h3>
                        <p class="text-muted small">انضم إلى مجتمع CampusGive لتشارك وتستفيد من التبرعات الجامعية</p>
                    </div>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $msg_type; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label fw-semibold">الاسم الكامل</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="أدخل اسمك الثلاثي" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">البريد الإلكتروني الجامعي</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@univ.edu.eg" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="01xxxxxxxxx">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-campus-primary w-100 py-2 fw-semibold rounded-3 mb-3">إنشاء الحساب</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="text-muted small mb-0">لديك حساب بالفعل؟ <a href="login.php" class="text-decoration-none fw-semibold" style="color: var(--primary-color);">تسجيل الدخول</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>