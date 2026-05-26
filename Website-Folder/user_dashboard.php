<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $category = $_POST['category'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $data = date('Y-m-d H:i:s') . " | Category: " . $category . " | Location: " . $location . " | Description: " . $description . " | Reported By: " . $_SESSION['user'] . "\n";
    file_put_contents('issues.txt', $data, FILE_APPEND);
    $success = "✅ Issue submitted successfully — Thank you!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard - Report Issue</title>
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
    input, select, textarea {
        width:100%;
        padding:12px;
        margin:8px 0 20px;
        border:1px solid #ccc;
        border-radius:8px;
        font-size:15px;
    }
    button {
        background:#4facfe;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:8px;
        font-size:16px;
        cursor:pointer;
    }
    .success { color:green; background:#e8f5e9; padding:10px; border-radius:8px; }
    .logout { text-align:right; margin-top:-10px; margin-bottom:20px; }
    .logout a { color:#dc3545; text-decoration:none; font-weight:bold; }
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
    <h1>User Section — Submit Maintenance Request Only</h1>
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
        <h2>Submit New Issue</h2>
        <?php if(isset($success)) echo "<div class='success'>$success</div>"; ?>

        <form method="POST">
            <label>Issue Category</label>
            <select name="category" required>
                <option>Electrical</option>
                <option>Plumbing</option>
                <option>HVAC / Cooling / Heating</option>
                <option>Furniture / Fixture Damage</option>
                <option>IT / Network / Devices</option>
                <option>Cleaning / Hygiene</option>
                <option>Structural / Building</option>
                <option>Other</option>
            </select>

            <label>Exact Location (Building / Block / Room No.)</label>
            <input type="text" name="location" required placeholder="e.g. Block B, Room 102">

            <label>Description of Issue</label>
            <textarea name="description" rows="5" required placeholder="Describe the problem clearly..."></textarea>

            <button type="submit" name="submit">Submit Report</button>
        </form>
    </div>
</div>
<footer>© 2026 Sonam Yangchen | Hosted on Cloud VM (Nginx Server)</footer>
</body>
</html>
