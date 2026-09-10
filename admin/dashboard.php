<?php

require_once "../includes/db.php";

$pageTitle = "لوحة التحكم";

/* =========================
   Statistics
========================= */

// Total users
$stmt = $conn->query("SELECT COUNT(*) FROM users");
$totalUsers = $stmt->fetchColumn();

// Total donations
$stmt = $conn->query("SELECT COUNT(*) FROM donations");
$totalDonations = $stmt->fetchColumn();

// Pending donations
$stmt = $conn->query("
    SELECT COUNT(*)
    FROM donations
    WHERE status = 'pending'
");
$pendingDonations = $stmt->fetchColumn();

// Approved donations
$stmt = $conn->query("
    SELECT COUNT(*)
    FROM donations
    WHERE status = 'approved'
");
$approvedDonations = $stmt->fetchColumn();


/* =========================
   Recent Donations
========================= */

$stmt = $conn->query("
    SELECT 
        donations.id,
        donations.category,
        donations.description,
        donations.image,
        donations.status,
        users.fullname
    FROM donations
    INNER JOIN users
        ON donations.user_id = users.id
    ORDER BY donations.id DESC
    LIMIT 5
");

$recentDonations = $stmt->fetchAll();


/* =========================
   Pending Donations
========================= */

$stmt = $conn->query("
    SELECT
        donations.id,
        donations.category,
        donations.description,
        users.fullname
    FROM donations
    INNER JOIN users
        ON donations.user_id = users.id
    WHERE donations.status = 'pending'
    ORDER BY donations.id DESC
    LIMIT 3
");

$pendingList = $stmt->fetchAll();


/* =========================
   Categories
========================= */

$categories = [
    "كتب ومراجع",
    "أدوات هندسية",
    "حاسبات وإلكترونيات",
    "مستلزمات عامة"
];

$categoryCounts = [];

foreach ($categories as $category) {

    $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM donations
        WHERE category = ?
    ");

    $stmt->execute([$category]);

    $categoryCounts[$category] = $stmt->fetchColumn();
}


/* =========================
   Category Progress
========================= */

function getCategoryPercentage($count, $total)
{
    if ($total == 0) {
        return 0;
    }

    return round(($count / $total) * 100);
}


/* =========================
   Include Header + Sidebar
========================= */

include "includes/admin-header.php";
include "includes/sidebar.php";

?>

<main class="admin-main">


    <!-- =========================
         Topbar
    ========================== -->

    <header class="admin-topbar">

        <div>

            <div class="topbar-title">

                <button class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                <div>

                    <h1>لوحة التحكم</h1>

                    <p>
                        مرحبًا بك في لوحة إدارة CampusGive
                    </p>

                </div>

            </div>

        </div>


        <div class="admin-profile">

            <div class="notification">

                <i class="bi bi-bell"></i>

                <?php if ($pendingDonations > 0): ?>

                    <span>
                        <?= $pendingDonations ?>
                    </span>

                <?php endif; ?>

            </div>


            <div class="profile-info">

                <div class="profile-avatar">
                    م
                </div>

                <div>

                    <strong>المدير</strong>

                    <small>مسؤول النظام</small>

                </div>

            </div>

        </div>

    </header>



    <!-- =========================
         Statistics
    ========================== -->

    <section class="stats-grid">


        <!-- Users -->

        <div class="stat-card">

            <div class="stat-icon users-icon">

                <i class="bi bi-people"></i>

            </div>

            <div>

                <span>
                    إجمالي المستخدمين
                </span>

                <h2>
                    <?= $totalUsers ?>
                </h2>

                <small class="positive">

                    <i class="bi bi-people"></i>

                    مستخدم مسجل

                </small>

            </div>

        </div>



        <!-- Donations -->

        <div class="stat-card">

            <div class="stat-icon donation-icon">

                <i class="bi bi-gift"></i>

            </div>

            <div>

                <span>
                    إجمالي التبرعات
                </span>

                <h2>
                    <?= $totalDonations ?>
                </h2>

                <small class="positive">

                    <i class="bi bi-gift"></i>

                    تبرع على المنصة

                </small>

            </div>

        </div>



        <!-- Pending -->

        <div class="stat-card">

            <div class="stat-icon pending-icon">

                <i class="bi bi-clock-history"></i>

            </div>

            <div>

                <span>
                    التبرعات قيد المراجعة
                </span>

                <h2>
                    <?= $pendingDonations ?>
                </h2>

                <small class="warning-text">

                    تحتاج إلى مراجعة

                </small>

            </div>

        </div>



        <!-- Approved -->

        <div class="stat-card">

            <div class="stat-icon request-icon">

                <i class="bi bi-check-circle"></i>

            </div>

            <div>

                <span>
                    التبرعات المقبولة
                </span>

                <h2>
                    <?= $approvedDonations ?>
                </h2>

                <small class="positive">

                    متاحة للمستخدمين

                </small>

            </div>

        </div>

    </section>



    <!-- =========================
         Main Dashboard
    ========================== -->

    <section class="dashboard-grid">


        <!-- =========================
             Recent Donations
        ========================== -->

        <div class="dashboard-card large-card">

            <div class="card-header">

                <div>

                    <h3>
                        أحدث التبرعات
                    </h3>

                    <p>
                        آخر التبرعات المضافة إلى المنصة
                    </p>

                </div>


                <a href="donations.php" class="view-all">

                    عرض الكل

                    <i class="bi bi-arrow-left"></i>

                </a>

            </div>


            <div class="table-container">

                <table class="admin-table">

                    <thead>

                        <tr>

                            <th>
                                التبرع
                            </th>

                            <th>
                                الخدمة
                            </th>

                            <th>
                                المتبرع
                            </th>

                            <th>
                                الحالة
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php if (count($recentDonations) > 0): ?>


                            <?php foreach ($recentDonations as $donation): ?>


                                <?php

                                // Donation icon
                                switch ($donation['category']) {

                                    case "كتب ومراجع":
                                        $icon = "bi-book";
                                        break;

                                    case "أدوات هندسية":
                                        $icon = "bi-tools";
                                        break;

                                    case "حاسبات وإلكترونيات":
                                        $icon = "bi-laptop";
                                        break;

                                    default:
                                        $icon = "bi-bag";
                                }


                                // Status
                                switch ($donation['status']) {

                                    case "approved":
                                        $statusText = "مقبول";
                                        $statusClass = "approved";
                                        break;

                                    case "rejected":
                                        $statusText = "مرفوض";
                                        $statusClass = "rejected";
                                        break;

                                    default:
                                        $statusText = "قيد المراجعة";
                                        $statusClass = "pending";
                                }

                                ?>


                                <tr>

                                    <td>

                                        <div class="donation-name">


                                            <div class="donation-img">

                                                <?php if (!empty($donation['image'])): ?>

                                                    <img src="../uploads/donations/<?= htmlspecialchars($donation['image']) ?>"
                                                        alt="صورة التبرع" style="
                                                            width:100%;
                                                            height:100%;
                                                            object-fit:cover;
                                                            border-radius:8px;
                                                        ">

                                                <?php else: ?>

                                                    <i class="bi <?= $icon ?>"></i>

                                                <?php endif; ?>

                                            </div>


                                            <strong>

                                                <?= htmlspecialchars(
                                                    mb_strimwidth(
                                                        $donation['description'],
                                                        0,
                                                        35,
                                                        "..."
                                                    )
                                                ) ?>

                                            </strong>


                                        </div>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $donation['category']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $donation['fullname']
                                        ) ?>

                                    </td>


                                    <td>

                                        <span class="badge <?= $statusClass ?>">

                                            <?= $statusText ?>

                                        </span>

                                    </td>

                                </tr>


                            <?php endforeach; ?>


                        <?php else: ?>


                            <tr>

                                <td colspan="4" style="text-align:center; padding:30px;">

                                    لا توجد تبرعات حتى الآن

                                </td>

                            </tr>


                        <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>



        <!-- =========================
             Pending Donations
        ========================== -->

        <div class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        التبرعات قيد المراجعة
                    </h3>

                    <p>
                        تبرعات تحتاج إلى موافقة الإدارة
                    </p>

                </div>


                <span class="count-badge">

                    <?= $pendingDonations ?>

                </span>

            </div>



            <div class="approval-list">


                <?php if (count($pendingList) > 0): ?>


                    <?php foreach ($pendingList as $donation): ?>


                        <?php

                        switch ($donation['category']) {

                            case "كتب ومراجع":
                                $icon = "bi-book";
                                break;

                            case "أدوات هندسية":
                                $icon = "bi-tools";
                                break;

                            case "حاسبات وإلكترونيات":
                                $icon = "bi-laptop";
                                break;

                            default:
                                $icon = "bi-bag";
                        }

                        ?>


                        <div class="approval-item">


                            <div class="approval-icon">

                                <i class="bi <?= $icon ?>"></i>

                            </div>


                            <div class="approval-content">

                                <strong>

                                    <?= htmlspecialchars(
                                        mb_strimwidth(
                                            $donation['description'],
                                            0,
                                            25,
                                            "..."
                                        )
                                    ) ?>

                                </strong>


                                <span>

                                    بواسطة

                                    <?= htmlspecialchars(
                                        $donation['fullname']
                                    ) ?>

                                </span>


                                <small>

                                    <?= htmlspecialchars(
                                        $donation['category']
                                    ) ?>

                                </small>

                            </div>


                            <a href="donations.php?id=<?= $donation['id'] ?>" class="more-btn" title="عرض التفاصيل">

                                <i class="bi bi-chevron-left"></i>

                            </a>

                        </div>


                    <?php endforeach; ?>


                <?php else: ?>


                    <div style="
                            text-align:center;
                            padding:25px;
                            color:var(--text-muted);
                        ">

                        <i class="bi bi-check-circle" style="font-size:32px;"></i>

                        <p style="margin-top:10px;">

                            لا توجد تبرعات قيد المراجعة

                        </p>

                    </div>


                <?php endif; ?>


            </div>



            <?php if ($pendingDonations > 0): ?>

                <a href="donations.php?status=pending" class="full-link">

                    مراجعة كل التبرعات

                    <i class="bi bi-arrow-left"></i>

                </a>

            <?php endif; ?>


        </div>

    </section>



    <!-- =========================
         Bottom
    ========================== -->

    <section class="bottom-grid">


        <!-- =========================
             Categories
        ========================== -->

        <div class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        التبرعات حسب الفئة
                    </h3>

                    <p>
                        توزيع التبرعات على الخدمات
                    </p>

                </div>

            </div>



            <div class="category-list">


                <!-- Books -->

                <div class="category-row">

                    <div>

                        <span class="category-dot books"></span>

                        كتب ومراجع

                    </div>

                    <strong>
                        <?= $categoryCounts["كتب ومراجع"] ?>
                    </strong>

                </div>


                <div class="progress-bar">

                    <span style="
                            width:<?= getCategoryPercentage(
                                $categoryCounts["كتب ومراجع"],
                                $totalDonations
                            ) ?>%;
                        "></span>

                </div>



                <!-- Engineering -->

                <div class="category-row">

                    <div>

                        <span class="category-dot tools"></span>

                        أدوات هندسية

                    </div>

                    <strong>
                        <?= $categoryCounts["أدوات هندسية"] ?>
                    </strong>

                </div>


                <div class="progress-bar">

                    <span style="
                            width:<?= getCategoryPercentage(
                                $categoryCounts["أدوات هندسية"],
                                $totalDonations
                            ) ?>%;
                        "></span>

                </div>



                <!-- Electronics -->

                <div class="category-row">

                    <div>

                        <span class="category-dot electronics"></span>

                        حاسبات وإلكترونيات

                    </div>

                    <strong>
                        <?= $categoryCounts["حاسبات وإلكترونيات"] ?>
                    </strong>

                </div>


                <div class="progress-bar">

                    <span style="
                            width:<?= getCategoryPercentage(
                                $categoryCounts["حاسبات وإلكترونيات"],
                                $totalDonations
                            ) ?>%;
                        "></span>

                </div>



                <!-- General -->

                <div class="category-row">

                    <div>

                        <span class="category-dot clothes"></span>

                        مستلزمات عامة

                    </div>

                    <strong>
                        <?= $categoryCounts["مستلزمات عامة"] ?>
                    </strong>

                </div>


                <div class="progress-bar">

                    <span style="
                            width:<?= getCategoryPercentage(
                                $categoryCounts["مستلزمات عامة"],
                                $totalDonations
                            ) ?>%;
                        "></span>

                </div>


            </div>

        </div>



        <!-- =========================
             Quick Actions
        ========================== -->

        <div class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        إجراءات سريعة
                    </h3>

                    <p>
                        إدارة المنصة بسهولة
                    </p>

                </div>

            </div>



            <div class="quick-actions">


                <!-- Review Donations -->

                <a href="donations.php?status=pending" class="quick-action">

                    <div>

                        <i class="bi bi-check2-circle"></i>

                    </div>


                    <span>

                        مراجعة التبرعات

                        <small>

                            <?= $pendingDonations ?>

                            تبرع قيد المراجعة

                        </small>

                    </span>


                    <i class="bi bi-chevron-left"></i>

                </a>



                <!-- Users -->

                <a href="users.php" class="quick-action">

                    <div>

                        <i class="bi bi-person-plus"></i>

                    </div>


                    <span>

                        إدارة المستخدمين

                        <small>

                            <?= $totalUsers ?>

                            مستخدم مسجل

                        </small>

                    </span>


                    <i class="bi bi-chevron-left"></i>

                </a>



                <!-- Requests -->

                <a href="requests.php" class="quick-action">

                    <div>

                        <i class="bi bi-hand-index-thumb"></i>

                    </div>


                    <span>

                        متابعة الطلبات

                        <small>

                            إدارة طلبات التبرع

                        </small>

                    </span>


                    <i class="bi bi-chevron-left"></i>

                </a>


            </div>

        </div>

    </section>


</main>


<?php include "includes/admin-footer.php"; ?>