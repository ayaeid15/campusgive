<?php
session_start();
include_once '../includes/header.php';
require_once '../includes/db.php';

// 1. استقبال رقم التبرع والحماية من XSS/SQL Injection
$donation_id = $_GET['id'] ?? null;

if (!$donation_id) {
    header("Location: ../index.php");
    exit();
}

$stmt = $conn->prepare("
    SELECT donations.*, users.fullname, users.email, users.phone 
    FROM donations 
    JOIN users ON donations.user_id = users.id 
    WHERE donations.id = :id 
    LIMIT 1
");
$stmt->execute(['id' => $donation_id]);
$donation = $stmt->fetch();

if (!$donation) {
    header("Location: ../index.php");
    exit();
}
// معالجة إرسال الطلب
$request_sent = false;
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id && $donation_id) {
    // التأكد هل اليوزر طلب التبرع ده قبل كده ولا لا
    $check_req = $conn->prepare("SELECT id FROM donation_requests WHERE donation_id = ? AND requester_id = ?");
    $check_req->execute([$donation_id, $user_id]);
    if ($check_req->fetch()) {
        $request_sent = true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_item']) && !$request_sent) {
        $owner_id = $donation['user_id'] ?? 1;
        $ins_req = $conn->prepare("INSERT INTO donation_requests (donation_id, requester_id) VALUES (?, ?)");
        if ($ins_req->execute([$donation_id, $user_id])) {
            $request_sent = true;
        }
    }
}
?>

<link rel="stylesheet" href="../assets/css/aya_style.css">

<div class="container my-5 pb-5" dir="rtl">
    <div class="glass-card p-4" text-right>
        <div class="row align-items-center">
            <!-- 1. تفاصيل التبرع (تظهر على اليمين) -->
            <div class="col-md-7 mb-4 mb-md-0 pl-md-4">
                <h2 class="text-plum font-weight-bold mb-3">
                    <?php echo htmlspecialchars($donation['title']); ?>
                </h2>

                <span class="badge badge-mauve p-2 mb-3">
                    <?php echo ($donation['status'] == 'approved' || $donation['status'] == 'available') ? 'متاح للتبرع' : htmlspecialchars($donation['status']); ?>
                </span>

                <div class="donor-info my-3">
                    <p class="mb-1"><strong>الكلية / القسم:</strong>
                        <?php echo htmlspecialchars($donation['category'] ?? 'عام'); ?>
                    </p>
                    <p class="mb-1"><strong>المتبرع:</strong>
                        <?php echo htmlspecialchars($donation['fullname'] ?? $donation['donor_name'] ?? 'غير محدد'); ?>
                    </p>
                    <p class="mb-1"><strong>تاريخ الإضافة:</strong>
                        <?php echo date('Y-m-d', strtotime($donation['created_at'] ?? 'now')); ?>
                    </p>
                </div>

                <div class="mt-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="POST">
                            <?php if ($request_sent): ?>
                                <button type="button" class="btn btn-success rounded-pill px-4 py-2 w-100" disabled>
                                    <i class="fa-solid fa-check-circle me-1"></i> تم إرسال الطلب بنجاح
                                </button>
                            <?php else: ?>
                                <button type="submit" name="request_item" class="btn btn-plum rounded-pill px-4 py-2 w-100">
                                    طلب التبرع الآن
                                </button>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <a href="../auth/login.php" class="btn btn-outline-mauve w-100 rounded-pill py-2">سجل دخولك لطلب
                            التبرع</a>
                    <?php endif; ?>

                    <!-- زر العودة لقائمة التبرعات -->
                    <a href="all_donations.php" class="btn btn-secondary mt-2 w-100 rounded-pill py-2">العودة
                        للقائمة</a>
                </div>
            </div>

            <!-- 2. صورة التبرع (تظهر على الشمال) -->
            <div class="col-md-5 text-center">
                <?php
                $db_image = !empty($donation['image']) ? trim($donation['image']) : '';
                $default_fallback = "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=600&auto=format&fit=crop";

                if (empty($db_image)) {
                    // لو مفيش صورة في الداتابيز
                    $image_src = $default_fallback;
                } elseif (filter_var($db_image, FILTER_VALIDATE_URL)) {
                    // لو القيمة المخزنة رابط مباشر (URL)
                    $image_src = $db_image;
                } else {
                    // لو القيمة اسم ملف محلي جوه assets/images
                    $image_src = "../assets/images/" . $db_image;
                }
                ?>
                <img src="<?php echo htmlspecialchars($image_src); ?>"
                    alt="<?php echo htmlspecialchars($donation['title']); ?>"
                    class="img-fluid rounded shadow-sm detail-img"
                    onerror="this.src='<?php echo $default_fallback; ?>';">
            </div>
        </div>
    </div>

    <!-- Request Modal (نافذة طلب التبرع) -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-plum">تقديم طلب للحصول على:
                        <?php echo htmlspecialchars($donation['title']); ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../requests/submit_request.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="donation_id" value="<?php echo $donation['id']; ?>">
                        <div class="form-group">
                            <label>سبب الاحتياج أو رسالة للمتبرع:</label>
                            <textarea name="request_message" class="form-control" rows="4" required
                                placeholder="اكتب التفاصيل هنا لمساعدة المتبرع على قبول طلبك..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-plum">إرسال الطلب</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>