</main>

<footer class="mt-5 py-4 border-top border-white"
    style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);">
    <div class="container">
        <div class="row g-4 mb-4">
            <!-- الشعار والوصف -->
            <div class="col-md-5">
                <a class="navbar-brand fw-bold fs-4 d-flex align-items-center mb-2" href="/campusgive/index.php"
                    style="color: var(--primary-color);">
                    CampusGive <i class="fa-solid fa-graduation-cap ms-2"></i>
                </a>
                <p class="text-muted small mb-0 ms-0" style="max-width: 320px;">
                    منصة التكامل والتكافل الطلابية المخصصة لتبادل ومشاركة الكتب والأدوات الدراسية داخل الحرم الجامعي بكل
                    سهولة وأمان.
                </p>
            </div>

            <!-- روابط سريعة -->
            <div class="col-6 col-md-3">
                <h6 class="fw-bold mb-3" style="color: var(--primary-color);">روابط سريعة</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="/campusgive/index.php"
                            class="text-decoration-none text-muted">الرئيسية</a></li>
                    <li class="mb-2"><a href="/campusgive/donations/browse.php"
                            class="text-decoration-none text-muted">تصفح التبرعات</a></li>
                    <li class="mb-2"><a href="/campusgive/donations/add.php"
                            class="text-decoration-none text-muted">إضافة تبرع</a></li>
                </ul>
            </div>

            <!-- التصنيفات -->
            <div class="col-6 col-md-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary-color);">الأقسام</h6>
                <div class="d-flex flex-wrap gap-2">
                    <a href="/campusgive/donations/browse.php?category=books"
                        class="badge bg-white text-dark border text-decoration-none px-3 py-2">كتب ومراجع</a>
                    <a href="/campusgive/donations/browse.php?category=tools"
                        class="badge bg-white text-dark border text-decoration-none px-3 py-2">أدوات هندسية</a>
                    <a href="/campusgive/donations/browse.php?category=tech"
                        class="badge bg-white text-dark border text-decoration-none px-3 py-2">إلكترونيات</a>
                </div>
            </div>
        </div>

        <div
            class="pt-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
            <p class="mb-2 mb-md-0">جميع الحقوق محفوظة &copy;
                <?php echo date('Y'); ?> CampusGive
            </p>
            <div>
                <span class="me-3"><i class="fa-solid fa-shield-halved me-1"></i> مجاني 100%</span>
                <span><i class="fa-solid fa-building-columns me-1"></i> دعم طلابي</span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>