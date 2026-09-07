<nav class="navbar navbar-expand-lg fixed-top my-3 mx-auto shadow-sm rounded-pill custom-glass-nav" 
     style="width: 92%; max-width: 1200px; background: rgba(253, 251, 247, 0.92); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(220, 200, 205, 0.6); z-index: 1030;">
    <div class="container-fluid px-3 px-md-4">
        
        <!-- اللوجو -->
        <a class="navbar-brand fw-bold fs-4 m-0" href="../index.php" style="color: #683A46; letter-spacing: -0.5px;">
            Campus<span style="color: #C5757C;">Give</span> 🎓
        </a>

        <!-- القائمة في المنتصف -->
        <div class="collapse navbar-collapse show justify-content-center" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0 gap-lg-3 flex-row justify-content-center">
                <li class="nav-item">
                    <a class="nav-link custom-nav-link px-2 px-md-3" href="../index.php">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-nav-link px-2 px-md-3" href="../donations/browse.php">تصفح التبرعات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-nav-link px-2 px-md-3" href="../donations/add.php">إضافة تبرع</a>
                </li>
            </ul>
        </div>

        <!-- أزرار الدخول/الحساب -->
        <div class="d-flex align-items-center gap-2">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="fw-semibold small d-none d-sm-inline" style="color: #140E1C;">
                    مرحباً، <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                </span>
                <a href="../auth/logout.php" class="btn btn-sm px-3 rounded-pill fw-semibold" style="border: 1px solid #683A46; color: #683A46;">خروج</a>
            <?php else: ?>
                <a href="../auth/login.php" class="btn btn-sm px-3 rounded-pill fw-semibold" style="color: #140E1C; border: 1px solid #E6D5CC;">دخول</a>
                <a href="../auth/register.php" class="btn btn-sm px-3 rounded-pill fw-semibold text-white shadow-sm" style="background-color: #683A46;">حساب جديد</a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<style>
.custom-nav-link {
    color: #140E1C !important;
    font-weight: 600;
    font-size: 0.95rem;
    position: relative;
    padding: 0.5rem 0.8rem !important;
    transition: color 0.3s ease;
}

.custom-nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2.5px;
    bottom: 2px;
    right: 50%;
    background-color: #A1525F;
    transition: all 0.3s ease;
    transform: translateX(50%);
    border-radius: 4px;
}

.custom-nav-link:hover {
    color: #A1525F !important;
}

.custom-nav-link:hover::after {
    width: 75%;
}

body {
    padding-top: 100px;
    background-color: #FAF6F3;
}
</style>