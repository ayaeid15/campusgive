<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = $_SERVER['REQUEST_URI'];
?>
<div class="container">
    <div class="container fixed-top pt-3" style="z-index: 1030;">
        <nav class="navbar navbar-expand-lg px-4 shadow-sm" style="background: rgba(255, 255, 255, 0.8) !important; 
                -webkit-backdrop-filter: blur(16px) saturate(180%); 
                backdrop-filter: blur(16px) saturate(180%); 
                border: 1px solid rgba(200, 150, 62, 0.15)); 
                border-radius: 50px !important; 
                padding-top: 14px !important; 
                padding-bottom: 14px !important;">

            <div class="container-fluid p-0">
                <!-- Brand / Logo -->
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/campusgive/index.php"
                    style="color: var(--primary-color);">
                    <i class="fa-solid fa-graduation-cap fs-4"></i>
                    <span>Campus<span style="color: var(--accent-color, #c8963e);">Give</span></span>
                </a>

                <!-- Toggler Button for Mobile -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->

                <div class="collapse navbar-collapse" id="navbarContent">

                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2 text-center">
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link <?php echo ($page == 'index.php') ? 'active' : ''; ?>"
                                href="/campusgive/index.php">
                                <i class="fa-solid fa-house me-1"></i> الرئيسية
                            </a>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link <?php echo ($page == 'browse.php') ? 'active' : ''; ?>"
                                href="/campusgive/donations/browse.php">
                                <i class="fa-solid fa-boxes-stacked me-1"></i> تصفح التبرعات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link <?php echo ($page == 'add.php') ? 'active' : ''; ?>"
                                href="/campusgive/donations/add.php">
                                <i class="fa-solid fa-circle-plus me-1"></i> إضافة تبرع
                            </a>
                        </li>

                    </ul>
                    <!-- User Auth Links -->
                    <div class="d-flex align-items-center justify-content-center gap-2 mt-3 mt-lg-0">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/campusgive/profile/index.php" class="btn btn-campus-outline btn-sm px-3 rounded-pill">
                                <i class="fa-regular fa-user me-1"></i> حسابي
                            </a>
                            <a href="/campusgive/auth/logout.php" class="btn btn-outline-danger btn-sm px-3 rounded-pill">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> خروج
                            </a>
                        <?php else: ?>
                            <a href="/campusgive/auth/login.php" class="btn btn-campus-outline btn-sm px-3 rounded-pill">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> دخول
                            </a>
                            <a href="/campusgive/auth/register.php" class="btn btn-campus-primary btn-sm px-3 rounded-pill">
                                <i class="fa-solid fa-user-plus me-1"></i> حساب جديد
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <style>
        body {
            padding-top: 100px;
        }

        /* تكبير ارتفاع الناف بار البيضاوي بأسلوب أنيق */
        .navbar {
            min-height: 65px !important;
        }
    </style>