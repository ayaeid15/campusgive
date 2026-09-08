<?php
require_once 'includes/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عن المنصة - CampusGive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <!-- السكشن الحاوي الكبير للـ About -->
        <div class="p-4 p-md-5 rounded-5 shadow-lg my-3"
            style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8);">

            <!-- الهيدر الداخلي -->
            <div class="text-center mb-5">
                <span class="badge px-3 py-2 rounded-pill mb-2"
                    style="background: rgba(104, 58, 70, 0.12); color: var(--primary-color, #683A46);">من نحن</span>
                <h2 class="fw-bold fs-1" style="color: var(--primary-color, #683A46);">CampusGive</h2>
                <p class="text-muted mx-auto" style="max-width: 650px;">رؤيتنا ورسالتنا لتسهيل الحياة الجامعية وبناء
                    مجتمع طلابي متكافل ومستدام.</p>
            </div>

            <!-- الجزء الأول: المشكلة والهدف -->
            <div class="row g-4 mb-5 align-items-stretch">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100 border-0 shadow-sm" style="background: rgba(255, 255, 255, 0.85);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3 text-white d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; background: var(--secondary-color, #A1525F);">
                                <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color: var(--primary-color, #683A46);">المشكلة التي نحلها
                            </h5>
                        </div>
                        <p class="text-muted leading-relaxed mb-0 small">
                            يواجه الكثير من الطلاب مع بداية كل ترم دراسي ارتفاع أسعار الكتب والملازم والأدوات الهندسية
                            أو الطبية. وفي المقابل، يمتلك طلاب آخرون نفس هذه الأدوات بعد إنهاء المواد دون حاجة إليها،
                            فتظل مركونة في المنازل دون استفادة.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100 border-0 shadow-sm" style="background: rgba(255, 255, 255, 0.85);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3 text-white d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; background: var(--primary-color, #683A46);">
                                <i class="fa-solid fa-bullseye fs-5"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color: var(--primary-color, #683A46);">هدف المنصة</h5>
                        </div>
                        <p class="text-muted leading-relaxed mb-0 small">
                            ربط الطلاب داخل الحرم الجامعي ببعضهم البعض بشكل مباشر ومجاني. نهدف لإنشاء جسر موثوق يسهل
                            انتقال الأدوات والكتب الدراسية بين الأجيال الطلابية المتعاقبة بدون أي مقابل مادي.
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-5" style="border-color: rgba(104, 58, 70, 0.15);">

            <!-- الجزء الثاني: القيم والرؤية -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 text-center h-100 border-0 shadow-sm"
                        style="background: rgba(255, 255, 255, 0.85);">
                        <i class="fa-solid fa-hand-holding-heart fs-2 mb-3"
                            style="color: var(--secondary-color, #A1525F);"></i>
                        <h6 class="fw-bold mb-2" style="color: var(--primary-color, #683A46);">دعم ومساعدة الطلاب</h6>
                        <p class="text-muted small mb-0">تخفيف العبء المالي عن كاهل الطلاب وأسرهم من خلال توفير
                            المستلزمات الأساسية مجاناً.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 text-center h-100 border-0 shadow-sm"
                        style="background: rgba(255, 255, 255, 0.85);">
                        <i class="fa-solid fa-recycle fs-2 mb-3" style="color: var(--secondary-color, #A1525F);"></i>
                        <h6 class="fw-bold mb-2" style="color: var(--primary-color, #683A46);">إعادة الاستخدام والإنقاذ
                        </h6>
                        <p class="text-muted small mb-0">تقليل الهدر وتعزيز ثقافة الاستدامة والتدوير الجماعي بدلاً من
                            التخلص من الأدوات الصالحة.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 text-center h-100 shadow-sm border-0"
                        style="background: rgba(255, 255, 255, 0.85);">
                        <i class="fa-solid fa-eye fs-2 mb-3" style="color: var(--secondary-color, #A1525F);"></i>
                        <h6 class="fw-bold mb-2" style="color: var(--primary-color, #683A46);">رؤية المشروع</h6>
                        <p class="text-muted small mb-0">أن نصبح المنصة الرقمية الأولى للتكافل الطلابي بالجامعات، وتحويل
                            المشاركة إلى قيمة وركيزة مجتمعية.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>