<?php
$host     = "localhost";
$db_user  = "root";
$db_pass  = "";
$db_name  = "campusgive_db";

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// ضبط الترميز لدعم اللغة العربية
mysqli_set_charset($conn, "utf8mb4");
?>