<footer class="mt-auto py-5"
    style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px); border-top: 1px solid rgba(220, 200, 205, 0.5);">
    <div class="container">
        <div class="row g-4 justify-content-between">

            <!-- العمود الأول: الشعار والوصف -->
            <div class="col-lg-5 col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-solid fa-graduation-cap fs-3 me-2" style="color: var(--primary-color, #683A46);"></i>
                    <span class="fw-bold fs-4" style="color: var(--primary-color, #683A46);">CampusGive</span>
                </div>
                <p class="text-muted small leading-relaxed mb-0" style="max-width: 380px;">
                    منصة التكامل والتكافل الطلابية المخصصة لتبادل ومشاركة الكتب والأدوات الدراسية داخل الحرم الجامعي بكل
                    سهولة وأمان.
                </p>
            </div>

            <!-- العمود الثاني: روابط سريعة (رأسية) -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3" style="color: var(--primary-color, #683A46);">روابط سريعة</h6>
                <ul class="list-unstyled p-0 m-0 d-flex flex-column gap-2">
                    <li>
                        <a href="/campusgive/index.php" class="footer-link-classic">الرئيسية</a>
                    </li>
                    <li>
                        <a href="/campusgive/about.php" class="footer-link-classic">عن المنصة</a>
                    </li>
                    <li>
                        <a href="/campusgive/donations/browse.php" class="footer-link-classic">تصفح التبرعات</a>
                    </li>
                </ul>
            </div>

        </div>

        <hr class="my-4" style="border-color: rgba(104, 58, 70, 0.15);">

        <!-- شريط حقوق الملكية -->
        <div class="text-center text-muted small">
            جميع الحقوق محفوظة &copy;
            <?php echo date('Y'); ?> CampusGive
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>