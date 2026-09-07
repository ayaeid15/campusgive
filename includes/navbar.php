<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="/campusgive/index.php">
      <!-- الرمز SVG فقط -->
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 60 60">
        <rect x="0" y="0" width="60" height="60" rx="14" fill="#6B2D5C" />
        <polygon points="30,12 48,22 30,32 12,22" fill="#FAF7F2" />
        <path d="M18,28 V35 C18,40 42,40 42,35 V28" fill="none" stroke="#FAF7F2" stroke-width="3" />
        <path d="M44,24 V32" fill="none" stroke="#2A6B7C" stroke-width="3" />
        <circle cx="44" cy="34" r="2" fill="#2A6B7C" />
        <path d="M22,46 C22,46 26,42 30,45 C34,42 38,46 38,46 C38,46 34,51 30,52 C26,51 22,46 22,46 Z" fill="#2A6B7C" />
      </svg>
      <!-- اسم المنصة كنص محاذى للشمال دائماً -->
      <span class="fw-bold fs-4 text-dark dir-ltr" style="letter-spacing: -0.5px;">
        Campus<span style="color: #6B2D5C;">Give</span>
      </span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="/campusgive/index.php">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="/campusgive/donations/browse.php">تصفح التبرعات</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="/campusgive/donations/add.php">إضافة تبرع</a></li>
      </ul>
      <div class="d-flex gap-2">
        <a href="/campusgive/auth/login.php" class="btn btn-outline-secondary btn-sm px-3">تسجيل الدخول</a>
        <a href="/campusgive/auth/register.php" class="btn btn-campus-primary btn-sm px-3">حساب جديد</a>
      </div>
    </div>
  </div>
</nav>