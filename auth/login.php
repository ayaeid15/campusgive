<?php 
session_start();
include '../includes/db.php';
include '../includes/header.php'; 
include '../includes/navbar.php'; 

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // التحقق من كلمة المرور المتشفرة
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: /campusgive/index.php");
            exit();
        } else {
            $message = "كلمة المرور غير صحيحة!";
        }
    } else {
        $message = "البريد الإلكتروني غير مسجل!";
    }
}
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">تسجيل الدخول</h3>
                        <p class="text-muted small">أدخل بياناتك للمتابعة في منصة CampusGive</p>
                    </div>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@univ.edu.eg" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-campus-primary w-100 py-2 fw-semibold rounded-3 mb-3">دخول</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="text-muted small mb-0">ليس لديك حساب؟ <a href="register.php" class="text-decoration-none fw-semibold" style="color: var(--primary-color);">حساب جديد</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>