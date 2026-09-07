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

<?php include '../includes/footer.php'; ?>