<?php
if (!isset($pageTitle)) {
    $pageTitle = "لوحة التحكم";
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CampusGive | <?= htmlspecialchars($pageTitle) ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

    <div class="admin-layout"></div>