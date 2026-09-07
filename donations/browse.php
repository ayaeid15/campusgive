<?php 
session_start();
include '../includes/db.php';
include '../includes/header.php'; 
include '../includes/navbar.php'; 

$query = "SELECT donations.*, users.fullname FROM donations 
          JOIN users ON donations.user_id = users.id 
          WHERE donations.status IN ('approved', 'reserved', 'completed')
          ORDER BY donations.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<main class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">تصفح التبرعات المتاحة</h2>
            <p class="text-muted small mb-0">استعرض الأدوات والكتب المتاحة من زملائك في الجامعة</p>
        </div>
        <a href="add.php" class="btn btn-campus-primary px-4 py-2 fw-semibold rounded-3">
            إضافة تبرع +
        </a>
    </div>

    <div class="row g-4">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-white rounded-4 overflow-hidden border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-category px-3 py-2 rounded-pill">
                                    <?php echo htmlspecialchars($row['category']); ?>
                                </span>
                                
                                <?php 
                                $status = $row['status'];
                                $status_text = [
                                    'approved' => 'متاح',
                                    'reserved' => 'محجوز',
                                    'completed' => 'مكتمل'
                                ];
                                $status_class = [
                                    'approved' => 'badge-approved',
                                    'reserved' => 'badge-reserved',
                                    'completed' => 'badge-completed'
                                ];
                                ?>
                                <span class="badge-status <?php echo $status_class[$status]; ?>">
                                    <?php echo $status_text[$status]; ?>
                                </span>
                            </div>

                            <h5 class="card-title fw-bold text-dark mb-1 text-truncate"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text flex-grow-1">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>
                            
                            <div class="flex-spacer"></div>

                            <div class="card-footer-custom">
                                <span class="text-muted small fw-medium text-truncate" style="max-width: 150px;">
                                    <?php echo htmlspecialchars($row['fullname']); ?>
                                </span>
                                <a href="details.php?id=<?php echo $row['id']; ?>" class="btn btn-campus-outline btn-sm px-3 rounded-2 fw-semibold">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">لا توجد تبرعات معروضة حالياً.</p>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php if (isset($_SESSION['welcome_message'])): ?>
<!-- Custom Interactive Glassmorphism Modal -->
<div id="welcomeModalOverlay" 
     style="position: fixed; 
            top: 0; left: 0; 
            width: 100vw; height: 100vh; 
            background: rgba(30, 20, 25, 0.55); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px); 
            z-index: 99999; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 15px;">

    <div class="card border-0 shadow-lg rounded-5 text-center p-4 p-md-5 position-relative overflow-hidden" 
         style="background: rgba(253, 251, 247, 0.95); 
                backdrop-filter: blur(25px); 
                -webkit-backdrop-filter: blur(25px); 
                border: 1px solid rgba(255, 255, 255, 0.8) !important; 
                max-width: 440px; 
                width: 100%;">
        
        <!-- زر الإغلاق ✕ -->
        <button type="button" 
                onclick="closeWelcomeModal()" 
                aria-label="Close"
                style="position: absolute; 
                       top: 15px; 
                       right: 20px; 
                       background: none; 
                       border: none; 
                       color: #8C2B4E; 
                       font-size: 1.8rem; 
                       cursor: pointer; 
                       line-height: 1; 
                       z-index: 10;
                       padding: 5px;">
            ✕
        </button>

        <!-- الأيقونة العلوية -->
        <div class="mb-3 d-flex justify-content-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                 style="width: 65px; height: 65px; background-color: #F5EBE6; border: 1px solid #E6D5CC;">
                <span class="fs-2">🎓</span>
            </div>
        </div>

        <!-- العنوان والرسالة -->
        <h4 class="fw-bold mb-2" style="color: #8C2B4E;">تم إنشاء الحساب بنجاح!</h4>
        <p class="mb-4 small text-muted" style="line-height: 1.7;">
            أهلاً بك يا <strong style="color: #4A3E3D;"><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong> في منصة CampusGive. سعداء بوجودك معنا لتسهيل الرحلة الدراسية ومشاركة التبرعات مع زملائك.
        </p>

        <!-- الأزرار التفاعلية -->
        <div class="d-grid gap-2">
            <button type="button" 
                    class="btn btn-campus-primary py-2.5 px-4 rounded-3 fw-semibold" 
                    onclick="closeWelcomeModal()"
                    style="cursor: pointer;">
                تصفح التبرعات المتاحة 📚
            </button>
            <a href="add.php" 
               class="btn btn-campus-outline py-2.5 px-4 rounded-3 fw-semibold"
               style="cursor: pointer;">
                إضافة أول تبرع +
            </a>
        </div>
    </div>
</div>

<script>
function closeWelcomeModal() {
    const modal = document.getElementById('welcomeModalOverlay');
    if (modal) {
        modal.style.opacity = '0';
        modal.style.transition = 'opacity 0.3s ease';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
}
</script>
<?php 
unset($_SESSION['welcome_message']); 
endif; 
?>


<?php include '../includes/footer.php'; ?>