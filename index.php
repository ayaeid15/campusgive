<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';
include 'includes/header.php';

// جلب أحدث 3 تبرعات متاحة للعرض في الصفحة الرئيسية
$query = "SELECT donations.*, users.fullname FROM donations 
          JOIN users ON donations.user_id = users.id 
          WHERE donations.status = 'approved'
          ORDER BY donations.created_at DESC LIMIT 3";
$result = mysqli_query($conn, $query);
?>

<!-- Hero Section -->
<section class="py-5 position-relative overflow-hidden" style="padding-top: 110px !important;">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 mx-auto d-flex flex-column align-items-center">
                <span
                    class="badge badge-category px-3 py-2 rounded-pill mb-3 shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-graduation-cap"></i> منصة التكافل والتبادل الطلابي
                </span>

                <h1 class="fw-bold display-4 mb-3 text-center" style="color: var(--primary-color);">
                    مرحباً بك في <span style="color: var(--secondary-color);">CampusGive</span>
                </h1>

                <p class="lead mb-4 text-center mx-auto"
                    style="color: var(--text-muted); line-height: 1.8; max-width: 600px;">
                    مجتمعك الجامعي لتبادل الأدوات والكتب واللوازم الدراسية بكل سهولة. شارك ما لا تحتاجه، وادعم زملاءك في
                    رحلتهم الأكاديمية.
                </p>

                <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                    <a href="donations/browse.php"
                        class="btn btn-campus-primary btn-lg px-4 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                        <span>تصفح التبرعات</span> <i class="fa-solid fa-book-open"></i>
                    </a>
                    <a href="donations/add.php"
                        class="btn btn-campus-outline btn-lg px-4 rounded-pill d-inline-flex align-items-center gap-2">
                        <span>إضافة تبرع</span> <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="py-5"
    style="background: rgba(255, 255, 255, 0.4); border-top: 1px solid rgba(220, 200, 205, 0.4); border-bottom: 1px solid rgba(220, 200, 205, 0.4);">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border-0">
                    <div class="fs-1 mb-3" style="color: var(--primary-color);">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary-color);">تبادل الكتب</h5>
                    <p class="text-muted small mb-0">وفر المراجع والمذكرات الدراسية للدفعة الجديدة بسهولة.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border-0">
                    <div class="fs-1 mb-3" style="color: var(--primary-color);">
                        <i class="fa-solid fa-ruler-combined"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary-color);">أدوات هندسية وعلمية</h5>
                    <p class="text-muted small mb-0">شارِك الحاسبات، المساطر، وأدوات المختبرات التي لم تعد تستخدمها.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border-0">
                    <div class="fs-1 mb-3" style="color: var(--primary-color);">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--primary-color);">تواصل مباشر</h5>
                    <p class="text-muted small mb-0">تواصل ومستلم الأدوات مباشرة داخل نطاق حرمك الجامعي.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Stats Section -->
<section class="pb-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border">
                    <i class="fa-solid fa-boxes-stacked fs-2 mb-2" style="color: var(--secondary-color, #A1525F);"></i>
                    <h4 class="fw-bold mb-1">+150</h4>
                    <p class="text-muted small mb-0">أداة مضافة</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border">
                    <i class="fa-solid fa-book-bookmark fs-2 mb-2" style="color: var(--secondary-color, #A1525F);"></i>
                    <h4 class="fw-bold mb-1">+300</h4>
                    <p class="text-muted small mb-0">كتاب مُتبادل</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border">
                    <i class="fa-solid fa-users-gear fs-2 mb-2" style="color: var(--secondary-color, #A1525F);"></i>
                    <h4 class="fw-bold mb-1">+500</h4>
                    <p class="text-muted small mb-0">طالب مستفيد</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100 border">
                    <i class="fa-solid fa-hand-holding-heart fs-2 mb-2"
                        style="color: var(--secondary-color, #A1525F);"></i>
                    <h4 class="fw-bold mb-1">100%</h4>
                    <p class="text-muted small mb-0">مجاني بالكامل</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- How It Works Section -->
<section class="py-5 bg-white bg-opacity-50 rounded-5 my-4 shadow-sm border border-white">
    <div class="container text-center">
        <h3 class="fw-bold mb-2" style="color: var(--primary-color, #4a154b);">كيف تعمل المنصة؟</h3>
        <p class="text-muted small mb-5">ثلاث خطوات بسيطة لمشاركة واستلام الأدوات والكتب الجامعية</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm"
                        style="width: 70px; height: 70px; background-color: rgba(161, 82, 95, 0.1); color: var(--secondary-color, #A1525F);">
                        <i class="fa-solid fa-cloud-arrow-up fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-2">1. اضف تبرعك</h5>
                    <p class="text-muted small mb-0">صور الأدوات أو الكتب التي لم تعد بحاجتها وارفعها للتطبيق في ثوانٍ.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm"
                        style="width: 70px; height: 70px; background-color: rgba(161, 82, 95, 0.1); color: var(--secondary-color, #A1525F);">
                        <i class="fa-solid fa-comments fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-2">2. تواصل مع زميلك</h5>
                    <p class="text-muted small mb-0">يتواصل معك الطالب المحتاج للغرض للتنسيق والاتفاق على موعد التسليم.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm"
                        style="width: 70px; height: 70px; background-color: rgba(161, 82, 95, 0.1); color: var(--secondary-color, #A1525F);">
                        <i class="fa-solid fa-handshake-angle fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-2">3. استلم في الحرم</h5>
                    <p class="text-muted small mb-0">يتم التبادل والتسليم مباشرة داخل الكلية أو نطاق الحرم الجامعي بكل
                        سهولة.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Donations Section -->
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-color);">أحدث التبرعات المتاحة</h3>
            <p class="text-muted small mb-0">إليك بعض المستلزمات التي تم إضافتها مؤخراً</p>
        </div>
        <a href="donations/browse.php" class="btn btn-campus-outline btn-sm px-3 rounded-pill">
            عرض الكل <i class="fa-solid fa-arrow-left ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4">
                    <div class="card h-100 rounded-4 overflow-hidden shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-category px-3 py-2 rounded-pill">
                                    <?php echo htmlspecialchars($row['category']); ?>
                                </span>
                                <span class="badge-status badge-approved">متاح</span>
                            </div>
                            <h5 class="card-title fw-bold mb-2 text-truncate" style="color: var(--text-dark);">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </h5>
                            <p class="card-text flex-grow-1">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>
                            <div class="flex-spacer"></div>
                            <div class="card-footer-custom">
                                <span class="small fw-medium text-truncate" style="color: var(--text-muted); max-width: 140px;">
                                    <i class="fa-regular fa-user me-1"></i><?php echo htmlspecialchars($row['fullname']); ?>
                                </span>
                                <a href="donations/details.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-campus-outline btn-sm px-3 rounded-pill fw-semibold">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">لا توجد تبرعات مضافة حالياً.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>