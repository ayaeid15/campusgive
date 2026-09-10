<?php
include 'header.php';

// معالجة حذف المستخدم
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $user_id");
    echo "<script>window.location.href='users.php';</script>";
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<style>
    .card-table { background: var(--card-bg); border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
    .table-title { color: var(--primary); margin-bottom: 20px; font-size: 1.4rem; }
    table { width: 100%; border-collapse: collapse; text-align: right; }
    th { background-color: var(--primary); color: white; padding: 12px; font-weight: 500; }
    td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.95rem; }
    .badge { padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; color: white; font-weight: 600; }
    .badge-admin { background-color: var(--primary); }
    .badge-user { background-color: var(--badge-user); }
    .btn-delete { color: var(--danger); background: #fee2e2; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; transition: 0.2s; }
    .btn-delete:hover { background: var(--danger); color: white; }
</style>

<div class="card-table">
    <h3 class="table-title">قائمة الطلاب والمستخدمين المسجلين بالمنصة</h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>الدور (Role)</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone'] ?? 'غير محدد'); ?></td>
                        <td>
                            <span class="badge <?php echo ($row['role'] === 'admin') ? 'badge-admin' : 'badge-user'; ?>">
                                <?php echo ($row['role'] === 'admin') ? 'أدمن' : 'مستخدم'; ?>
                            </span>
                        </td>
                        <td>
                            <a href="users.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('هل أنت تأكد من حذف هذا المستخدم؟');">
                                <i class="fa-solid fa-trash"></i> حذف
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align: center;">لا يوجد مستخدمين مسجلين.</td></tr>
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