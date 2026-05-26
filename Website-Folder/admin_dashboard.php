<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}


if (isset($_GET['del'])) {
    $all = file('issues.txt', FILE_IGNORE_NEW_LINES);
    unset($all[$_GET['del']]);
    file_put_contents('issues.txt', implode("\n", $all));
    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Manage Issues</title>
<style>
    body {
        margin: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: linear-gradient(135deg, #e3f2fd, #f5f7fb);
        color: #222;
    }
    header {
        background: linear-gradient(90deg, #1e2a38, #2c3e50);
        color: white;
        padding: 30px;
        text-align: center;
        letter-spacing: 1px;
    }
    header h1 { margin: 0; font-size: 28px; }
    .container { width: 80%; margin: 40px auto; }
    .card {
        background: white;
        padding: 30px;
        margin-bottom: 25px;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .info-box {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        text-align: center;
        margin-bottom:30px;
    }
    .info {
        background: #eef2f7;
        padding:22px;
        border-radius:12px;
        font-weight:bold;
        transition:0.3s;
    }
    .info:hover { background: #dbe7f5; transform: translateY(-3px); }
    .info a { text-decoration:none; color:#1e2a38; font-size:18px; }
    h2 {
        color: #1e2a38;
        border-left: 5px solid #4facfe;
        padding-left: 10px;
        margin-bottom: 20px;
    }
    .logout { text-align:right; margin-top:-10px; margin-bottom:20px; }
    .logout a { color:#dc3545; text-decoration:none; font-weight:bold; }
    .issue {
        border:1px solid #e0e0e0;
        padding:20px;
        border-radius:12px;
        margin-bottom:15px;
        position:relative;
        background:#fafafa;
    }
    .del-btn {
        position:absolute;
        right:20px;
        top:20px;
        background:#28a745;
        color:white;
        border:none;
        padding:8px 15px;
        border-radius:6px;
        text-decoration:none;
        font-size:13px;
        font-weight:bold;
    }
    .del-btn:hover { background:#218838; }
    .empty { text-align:center; color:#777; padding:40px; }
    .label { font-weight:bold; color:#1e2a38; }
    footer {
        text-align: center;
        padding: 18px;
        background: #1e2a38;
        color: white;
        margin-top: 40px;
        font-size: 14px;
    }
</style>
</head>
<body>
<header>
    <h1>ICT171 Cloud Server Project</h1>
    <h1>Admin Section — View & Manage All Issues</h1>
</header>
<div class="container">
    <div class="info-box">
        <div class="info"><a href="index.html">Home</a></div>
        <div class="info"><a href="login.php">Maintenance</a></div>
        <div class="info"><a href="server_info.html">Server Information</a></div>
        <div class="info"><a href="license.html">License</a></div>
        <div class="info"><a href="contact.html">Contact Us</a></div>
    </div>

    <div class="card">
        <div class="logout"><a href="logout.php">🚪 Logout</a></div>
        <h2>All Reported Issues</h2>

        <?php if (!file_exists('issues.txt') || filesize('issues.txt') === 0): ?>
            <div class="empty">📭 No issues have been reported yet.</div>
        <?php else: ?>
            <?php $records = array_reverse(file('issues.txt'), true); foreach ($records as $i => $r): ?>
            <div class="issue">
                <a href="admin_dashboard.php?del=<?= $i ?>" class="del-btn">✅ Mark Completed / Delete</a>
                <?php
                $details = explode(" | ", trim($r));
                foreach ($details as $d) {
                    echo "<div><span class='label'>" . htmlspecialchars($d) . "</span></div>";
                }
                ?>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<footer>© 2026 Sonam Yangchen | Hosted on Cloud VM (Nginx Server)</footer>
</body>
</html>
