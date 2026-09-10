<?php
include 'header.php';

// معالجة القبول أو الرفض
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = ($_GET['action'] === 'approve') ? 'approved' : 'rejected';
    $conn->query("UPDATE donations SET status='$status' WHERE id=$id");
    echo "<script>window.location.href='pending_donations.php';</script>";
}

$result = $conn->query("SELECT d.*, u.fullname FROM donations d LEFT JOIN users u ON d.user_id = u.id WHERE d.status='pending' ORDER BY d.id DESC");
?>

<style>
    .card-table { background: var(--card-bg); border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
    .table-title { color: var(--primary); margin-bottom: 20px; font-size: 1.4rem; }
    table { width: 100%; border-collapse: collapse; text-align: right; }
    th { background-color: var(--primary); color: white; padding: 12px; }
    td { padding: 12px; border-bottom: 1px solid #eee; }
    .btn-action { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; color: white; display: inline-block; }
    .btn-approve { background-color: var(--success); }
    .btn-reject { background-color: var(--danger); }
</style>

<div class="card-table">
    <h3 class="table-title">التبرعات المرفوعة حديثاً (بانتظار الموافقة)</h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان التبرع</th>
                <th>القسم</th>
                <th>المتبرع</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['category'] ?? 'عام'); ?></td>
                        <td><?php echo htmlspecialchars($row['fullname'] ?? 'مجهول'); ?></td>
                        <td>
                            <a href="pending_donations.php?action=approve&id=<?php echo $row['id']; ?>" class="btn-action btn-approve"><i class="fa-solid fa-check"></i> موافقة</a>
                            <a href="pending_donations.php?action=reject&id=<?php echo $row['id']; ?>" class="btn-action btn-reject"><i class="fa-solid fa-xmark"></i> رفض</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">لا توجد تبرعات بانتظار الموافقة حالياً.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</main>

<script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });
</script>
</body>
</html>