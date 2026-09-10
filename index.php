<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';
include 'includes/header.php';

// جلب أحدث 3 تبرعات متاحة للعرض في الصفحة الرئيسية<?php
$query = "SELECT donations.*, users.fullname FROM donations 
          JOIN users ON donations.user_id = users.id 
          WHERE donations.status = 'approved'
          ORDER BY donations.created_at DESC LIMIT 3";

// تمرير المتغير $query بدلاً من النص الناقص
$stmt = $conn->query($query);
$donations = $stmt->fetchAll();
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
        <?php if (!empty($donations)): ?>
            <?php foreach ($donations as $row): ?>
                <div class="col-md-4">
                    <div class="card h-100 rounded-4 overflow-hidden shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-category px-3 py-2 rounded-pill">
                                    <?php echo htmlspecialchars($row['category'] ?? 'عام'); ?>
                                </span>
                                <span class="badge-status badge-approved">متاح</span>
                            </div>
                            <h5 class="card-title fw-bold mb-2 text-truncate">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </h5>
                            <p class="card-text flex-grow-1">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>
                            <div class="flex-spacer"></div>
                            <div
                                class="card-footer-custom d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <span class="small fw-medium text-truncate">
                                    <i class="fa-regular fa-user me-1"></i><?php echo htmlspecialchars($row['fullname']); ?>
                                </span>
                                <a href="donations/details.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-campus-outline btn-sm px-3 rounded-pill">
                                    التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">لا توجد تبرعات مضافة حالياً.</p>
            </div>
        <?php endif; ?>
    </div>


</section>
<!-- Categories Section -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="fw-bold mb-2" style="color: var(--primary-color, #4a154b);">الأقسام الرئيسية</h3>
        <p class="text-muted small mb-4">اختر القسم الذي تبحث فيه لتسهيل الوصول للأدوات</p>

        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <a href="/campusgive/donations/browse.php?category=books"
                    class="text-decoration-none text-dark d-block">
                    <div class="p-4 rounded-4 bg-white shadow-sm border h-100 category-card">
                        <i class="fa-solid fa-book-open fs-2 mb-3 text-primary"></i>
                        <h6 class="fw-bold mb-0">كتب ومراجع</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/campusgive/donations/browse.php?category=tools"
                    class="text-decoration-none text-dark d-block">
                    <div class="p-4 rounded-4 bg-white shadow-sm border h-100 category-card">
                        <i class="fa-solid fa-compass-drafting fs-2 mb-3 text-primary"></i>
                        <h6 class="fw-bold mb-0">أدوات هندسية</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/campusgive/donations/browse.php?category=tech" class="text-decoration-none text-dark d-block">
                    <div class="p-4 rounded-4 bg-white shadow-sm border h-100 category-card">
                        <i class="fa-solid fa-calculator fs-2 mb-3 text-primary"></i>
                        <h6 class="fw-bold mb-0">حاسبات وإلكترونيات</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/campusgive/donations/browse.php?category=general"
                    class="text-decoration-none text-dark d-block">
                    <div class="p-4 rounded-4 bg-white shadow-sm border h-100 category-card">
                        <i class="fa-solid fa-folder-open fs-2 mb-3 text-primary"></i>
                        <h6 class="fw-bold mb-0">مستلزمات عامة</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Accordion Section -->
<section class="py-5 bg-white bg-opacity-50 rounded-5 my-4 shadow-sm border border-white">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-2" style="color: var(--primary-color, #4a154b);">الأسئلة الشائعة</h3>
            <p class="text-muted small">إليك إجابات لأكثر الأسئلة تداولاً بين الطلاب</p>
        </div>

        <div class="accordion accordion-flush max-w-750 mx-auto" id="faqAccordion" style="max-width: 750px;">
            <div class="accordion-item bg-transparent border-0 mb-3 shadow-sm rounded-4 overflow-hidden border">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq1">
                        هل المنصة مجانية بالكامل؟
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small bg-white">
                        نعم، المنصة مجانية 100% ومخصصة لدعم التكافل والتبادل الطلابي داخل الكلية بدون أي مقابل مادي.
                    </div>
                </div>
            </div>

            <div class="accordion-item bg-transparent border-0 mb-3 shadow-sm rounded-4 overflow-hidden border">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                        كيف يتم تسليم الكتب والأدوات بين الطلاب؟
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small bg-white">
                        بعد طلب الأداة، يمكنك التواصل مباشرة مع صاحب التبرع والتنسيق معه لمقابلته داخل الحرم الجامعي في
                        المكان والموعد المناسب لكما.
                    </div>
                </div>
            </div>

            <div class="accordion-item bg-transparent border-0 mb-3 shadow-sm rounded-4 overflow-hidden border">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq3">
                        كيف يمكنني إضافة أداة أو كتاب للتبرع؟
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small bg-white">
                        قم بتسجيل الدخول إلى حسابك، ثم اضغط على زر "إضافة تبرع" واملأ تفاصيل الأداة والصورة لتكون متاحة
                        فوراً لزملائك.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action (CTA) Banner -->
<section class="py-5 text-center text-white rounded-5 my-4 shadow"
    style="background: linear-gradient(135deg, var(--primary-color, #4a154b), #2d0b2e);">
    <div class="container py-3">
        <h3 class="fw-bold mb-3">هل لديك أدوات أو كتب لم تعد بحاجتها؟</h3>
        <p class="mb-4 opacity-75">شاركها مع زملائك في الجامعة وكن سبباً في دعم رحلتهم الأكاديمية.</p>
        <a href="/campusgive/donations/add.php"
            class="btn btn-light rounded-pill px-4 py-2 fw-bold text-dark shadow-sm">
            <i class="fa-solid fa-plus-circle me-1"></i> أضف تبرعك الآن
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>