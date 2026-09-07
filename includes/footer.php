</main> <!-- نهاية الـ main container -->

<footer class="mt-auto py-4" 
        style="background: var(--glass-bg); 
               backdrop-filter: blur(12px); 
               -webkit-backdrop-filter: blur(12px); 
               border-top: 1px solid var(--glass-border); 
               color: var(--text-dark);">
    <div class="container text-center">
        <div class="row align-items-center gy-3">
            
            <!-- حقوق النشر واللوجو -->
            <div class="col-md-6 text-md-start">
                <span class="fw-bold fs-5 me-2" style="color: var(--primary-color);">Campus<span style="color: var(--accent-color);">Give</span> 🎓</span>
                <small class="d-block d-sm-inline text-muted mt-1 mt-sm-0">
                    &copy; <?php echo date('Y'); ?> جميع الحقوق محفوظة للطلاب.
                </small>
            </div>

            <!-- روابط سريعة للفوتر -->
            <div class="col-md-6 text-md-end">
                <ul class="list-inline mb-0 small">
                    <li class="list-inline-item me-3">
                        <a href="../index.php" class="text-decoration-none" style="color: var(--text-dark); transition: color 0.2s;" onmouseover="this.style.color='var(--secondary-color)'" onmouseout="this.style.color='var(--text-dark)'">الرئيسية</a>
                    </li>
                    <li class="list-inline-item me-3">
                        <a href="../donations/browse.php" class="text-decoration-none" style="color: var(--text-dark); transition: color 0.2s;" onmouseover="this.style.color='var(--secondary-color)'" onmouseout="this.style.color='var(--text-dark)'">التبرعات</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="../donations/add.php" class="text-decoration-none" style="color: var(--text-dark); transition: color 0.2s;" onmouseover="this.style.color='var(--secondary-color)'" onmouseout="this.style.color='var(--text-dark)'">إضافة تبرع</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>