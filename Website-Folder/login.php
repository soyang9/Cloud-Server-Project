<?php
session_start();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_id = trim($_POST['user_id']);
    $input_pass = trim($_POST['password']);
    $input_role = trim($_POST['role']); // get which button you clicked
    $login_ok = false;
    $user_role = "";

  
    $lines = file(__DIR__ . '/user.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode(":", $line);
        if (count($parts) === 3) {
            $stored_id   = trim($parts[0]);
            $stored_pass = trim($parts[1]);
            $stored_role = trim($parts[2]);

            
            if ($input_id === $stored_id && $input_pass === $stored_pass && $input_role === $stored_role) {
                $login_ok = true;
                $user_role = $stored_role;
                break;
            }
        }
    }

    if ($login_ok) {
        $_SESSION['user'] = $input_id;
        $_SESSION['role'] = $user_role;
        $_SESSION['loggedin'] = true;

        if ($user_role === 'user') {
            header("Location: user_dashboard.php");
            exit;
        } elseif ($user_role === 'admin') {
            header("Location: admin_dashboard.php");
            exit;
        }
    } else {
        $error = "❌ Wrong ID / Password OR wrong button clicked — try again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Maintenance Services</title>
<style>
    body {
        margin: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: #f0f4f8;
    }
    header {
        background: #2c3e50;
        color: white;
        padding: 25px;
        text-align: center;
    }
    header h1 {
        margin: 0;
        font-size: 26px;
    }
    .container {
        width: 400px;
        margin: 60px auto;
    }
    .card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
    }
    .card h2 {
        color: #2c3e50;
        margin-bottom: 10px;
    }
    .desc {
        color: #555;
        margin-bottom: 25px;
        font-size: 15px;
        line-height: 1.5;
    }
    .role-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }
    .role-btn {
        flex: 1;
        padding: 14px;
        border: 2px solid transparent;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    .user-btn {
        background: #3498db;
        color: white;
    }
    .admin-btn {
        background: #27ae60;
        color: white;
    }
    
    .role-btn.active {
        border-color: #2c3e50;
        box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.2);
    }
    input {
        width: 100%;
        padding: 12px;
        margin: 8px 0 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
    }
    .login-btn {
        width: 100%;
        background: #2c3e50;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }
    .error {
        color: #e74c3c;
        background: #fdecea;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .selected-note {
        color: #27ae60;
        font-weight: bold;
        margin-bottom: 15px;
        display: none;
    }
    footer {
        text-align: center;
        color: #777;
        font-size: 13px;
        margin-top: 30px;
    }
</style>
</head>
<body>

<header>
    <h1>Maintenance Services</h1>
</header>

<div class="container">
    <div class="card">
        <h2>Welcome</h2>
        <p class="desc">
            Click <b>User</b> → submit issues<br>
            Click <b>Admin</b> → maintenance team (view & manage)
        </p>

        <div class="role-buttons">
            <button class="role-btn user-btn" onclick="selectRole('user', this)">USER</button>
            <button class="role-btn admin-btn" onclick="selectRole('admin', this)">ADMIN</button>
        </div>

        <div class="selected-note" id="selectedNote">✅ You selected: <span id="roleText"></span></div>

        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST" action="">
            <input type="hidden" name="role" id="roleInput" value=""> <!-- ✅ Sends which one you clicked -->
            <input type="text" name="user_id" required placeholder="Enter your User ID">
            <input type="password" name="password" required placeholder="Enter your Password">
            <button type="submit" class="login-btn">LOGIN</button>
        </form>
    </div>

    <footer>© 2026 Sonam Yangchen | Hosted on Cloud VM (Nginx Server)</footer>
</div>

<script>
function selectRole(role, btn) {
    // Save selected role
    document.getElementById('roleInput').value = role;
    document.getElementById('roleText').textContent = role.toUpperCase();
    document.getElementById('selectedNote').style.display = 'block';

    // Highlight clicked button
    document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
</script>

</body>
</html>
