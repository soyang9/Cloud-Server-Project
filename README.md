# ICT171 Cloud Server Project: Cloud-based Maintenance Service System

**Student Name:** Sonam Yangchen
**Student ID:** 35867346
**Course ID:** ICT171 - Cloud Server Administration
**Submission:** 2nd June 2026
**Hosting Platform:** Microsoft Azure (IaaS Virtual Machine)

## Website Links
**Public IP Address:** http://20.5.42.159
**Domain Name:** www.sonamict171.com

## Project Overview
- This project is a Cloud-based Maintenance Service System hosted using Microsoft Azure where users can submit maintenance issues online, example: broken lights, AC repair or any other maintenance isuues.
- **Users:** Login securely → submit maintenance issues with category, location and description.
- **Administrators:** Login securely → view all issues → mark completed / delete
- All data stored in flat `.txt` files (no database used)
It focuses on cloud deployment and infrastracture as a service(IaaS).

##  Technologies Used
- **Infrastructure:** Microsoft Azure Virtual Machine
- **Image:** Ubuntu Server 24.04 LTS
- **VM Size:** B-Series (Budget-friendly)
- **Web Server:** Nginx-full
- **Frontend:** HTML, CSS
- **Scripting:** PHP 8.3, JavaScript
- **Domain:** Registered and managed via Namecheap
- **Version Control:** GitHub

## TECHNICAL DOCUMENTATION
### Server Setup (Azure Portal and SSH Terminal)
#### Step 1 - Create Virtual Machine in Azure
1. Log in as Student in to Azure Portal: https://portal.azure.com.
2. Search for **Virtual Machines** → Click **Create → Virtual machine**
3. **Subscription:** Select **Azure for Students**
4. **Resource group:** Name e.g. `Web Server Resource Group`
5. **Virtual machine name:** e.g. `ict171-web-server`
6. **Region:** Australia East / East Asia (closest location)
7. **Image:** **Ubuntu Server 24.04 LTS**
8. **Size:** Select **B-Series** (e.g. Standard B1s — budget-friendly)
9. **Authentication type:** **SSH public key**
10. **Key pair name:** e.g. `webserver-key` → Save `.pem` file safely
11. **Inbound port rules:**
    - ✅ SSH (22) – already allowed
    - ✅ Select **HTTP (80)** – allow web traffic
12. Disks / Networking / Tags: Leave all as **Default**
13. Click **Review + create** → **Create

#### Step 2 - Connecting to the Server using SSH
- Connection to the cloud server was completed using SSH through Windows PowerShell.
- Command used:
```bash
ssh -i "C:\Users\sonam171\.ssh\Sonamstd_key.pem" azureuser@20.5.42.159
```

This command allows secure command-line access to the server for configuration and administration roles.

<img width="1205" height="763" alt="image" src="https://github.com/user-attachments/assets/f66da83d-abad-43b5-98a7-75ea0b102495" />
                           
                            **Steps**
1. Open Terminal / PowerShell → go to folder where you saved `.pem` key
2. Copy the path.
3. Run command:
```bash
ssh -i "key.pem(folder path)" azureuser@server ip address
```
4. Now you are logged into your cloud server.
   
#### Step 3 - Installation of required Software
1. Update system
```bash
sudo apt update
```
<img width="1182" height="426" alt="image" src="https://github.com/user-attachments/assets/7101e983-e28c-411d-9c3c-3e46ef0b5f78" />

2. Install Nginx web server
```bash
sudo apt install nginx-full -y
```
<img width="758" height="140" alt="image" src="https://github.com/user-attachments/assets/cd8bfc1d-8c56-41ea-a853-05530fbf9a1d" />

3. Install PHP 8.3 to run scripts
```bash
sudo apt install php8.3 php8.3-fpm -y
```

#### Step 4 - Nginx Configutation.
1. Config file location
```bash
   /etc/nginx/sites-available/default
```
2. Bellow is tha default file set by Nginx
   <img width="1247" height="625" alt="image" src="https://github.com/user-attachments/assets/08b3e6ce-21c6-4416-b1c9-945dbba14d15" />

3. Command used to check and restart service.
```bash
sudo nginx -t
sudo systemctl restart nginx
```
#### Step 5 Uploaded Project Files
- All files are uploaded directly into /var/www/html/:
1. index.html - Home Page
2. login.php - Login page with User/Admin buttons.
3. user_dashboard.php - Users page to submit maintenance issues/reports.
4. admin_dashboard.php - Admin/maintenance department to manage the reports.
5. logout.php - logout functionality
6. user.txt - login details (format: ID:Password:Role)
7. issues.txt - Stores all submitted reports.
8. Server_info.html, license.html, contact.html - Extra infomation pages.

**Set File Permission**
- Used these commands so that website can read and write data files:
```bash
sudo chmod 666 /var/www/html/user.txt /var/www/html/issues.txt
sudo chown -R www-data:www-data /var/www/html/
```
This steps helps to save login details or reports.

### Modifications and Additions
**1. Login Page (login.php)**
- Added role check: User must click either “User” or “Admin” button before entering credentials.
- Added JavaScript: Buttons highlight when selected, shows confirmation message, and stores role in hidden input (W3School, n.d.c)
- Strict authentication logic: Verifies ID, Password, and Selected Role match stored data.
- Session management: Start session, stores user, role, and logged in statis on success.
- Automatic redirection: Sends user to user_dashboard.php and admin to admin_dashboard.php
- Clear error message: “Wrong ID / Password or wrong button clicked- try again” displayed for failed login
- Custom styling: Embedded CSS matching site theme, responsive card layout, hover and active status. 

**PHP Code I Added:**
```bash
if ($input_id === $stored_id && $input_pass === $stored_pass && $input_role === $stored_role) {
    $_SESSION['role'] = $stored_role;
    header("Location: user_dashboard.php");
}
```
**JavaScript Code Added:**
```bash
function selectRole(role, btn) {
    document.getElementById('roleInput').value = role;
    document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
```
**2. User Dashboard (user_dashboard.php)**
- Added security: Cannot access page without active login session
- Added JavaScript features: Character counter while typing and confirmation popup before submitting.
- Automatic timestamp added to every report
- Success message displayed after submission
- **Security Code Added:**
```bash
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
```
**3. Admin Dashboard (admin_dashboard.php)**
- Restricted access: Only admin role permitted
- Displays all reports sorted by submission time
- Full details visible: Date, User ID, Issue Type, Location, Description
- Delete functionality to remove resolved reports
- Data read directly from issues.txt file

### Scripting and Coding examples

**1. Html Example - Home Page**
- Given code is an example used in index.html, it creates the navigation menu with five clickable links. It lets users move easily between Home Page, Maintenance Form, Server Info, License and Contact pages.
```bash
<div class="info-box">
    <div class="info"><a href="index.html">Home</a></div>
    <div class="info"><a href="login.php">Maintenance</a></div>
    <div class="info"><a href="server.html">Server Information</a></div>
    <div class="info"><a href="license.html">License</a></div>
    <div class="info"><a href="contact.html">Contact Us</a></div>
</div>
```
**2. CSS Example: Navigation Box Styling**
- It styles the top header area with a dark blue gradient backgrounf, white text, centre-aligned content and spacing between letters for a clean look. 
```bash
header {
    background: linear-gradient(90deg, #1e2a38, #2c3e50);
    color: white;
    padding: 30px;
    text-align: center;
    letter-spacing: 1px;
}
```
**3. PHP Example: Login Authentication**
- This script used in login.php, reads user credentials from user.txt, verifies the input, and starts a session if valid or not.
```bash
<?php
session_start();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_id = trim($_POST['user_id']);
    $input_pass = trim($_POST['password']);
    $input_role = trim($_POST['role']);
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
```

**4. JavaScript Example: Role Selection and UI Feedback (login.php)**
- This script is also used in login.php, which helps in handling role selection and visual highlighting of buttons.
```bash
function selectRole(role, btn) {
    document.getElementById('roleInput').value = role;
    document.getElementById('roleText').textContent = role.toUpperCase();
    document.getElementById('selectedNote').style.display = 'block';

    document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
```
**5. PHP – User Dashboard & Report Submission (user_dashboard.php)**
- This PHP script performs security validation, processes maintenance request form submissions, formats the collected data with timestamps and user information, saves the records to a text file (issues.txt), and provides feedback to the user upon successful submission.
 ```bash
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $category = $_POST['category'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $data = date('Y-m-d H:i:s') . " | Category: " . $category .
            " | Location: " . $location .
            " | Description: " . $description .
            " | Reported By: " . $_SESSION['user'] . "\n";

    file_put_contents('issues.txt', $data, FILE_APPEND);

    $success = "✅ Issue submitted successfully!";
}
?>
 ```
**6. PHP - Admin dashboard and issue management**
- This script provides a secure administrator dashboard.
- It reads maintenance requests from issues.txt, displays them for review, and allows administrators to mark completed issues for removal from the system.
 ```bash
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

if (!file_exists('issues.txt') || filesize('issues.txt') === 0) {
    echo "No issues have been reported yet.";
} else {
    $records = array_reverse(file('issues.txt'), true);
    foreach ($records as $i => $r) {
        echo htmlspecialchars($r);
    }
}
?>
 ```
### Domain and Security Setup
**1. DNS Configuration (Namecheap)**
- I bought my domain and linked it to Azure Server:
- Domain name was connected to the IP address of Azure using Namecheap DNS.
- **Steps:**
- Log in to Namecheap → My Domains → www.sonamict171.com → Advanced DNS
- Added these records:
Type	Host	Value	TTL
A Record	@	20.5.42.159	300
A Record	www	20.5.42.159	300
<img width="389" height="73" alt="image" src="https://github.com/user-attachments/assets/b8f70d54-5b12-44a6-b5a3-918a5a4b61f1" />

- My Azure IP address was given in the Value.
- An A Record was created so that the domain name points to the Azure virtual machine.

**2. Enabled HTTPS (Secure Website):**
- Installed free SSL certificate to show padlock icon using the command:
```bash
    sudo apt install certbot python3-certbot-nginx -y
    sudo certbot --nginx -d sonamict171.com -d www.sonamict171.com
```

**3. Testing the Website**
- After configuring DNS, my website was tested using a web browser.

- I confirmed that the website was accessible:

```text
http://www.sonamict171.com
```
- I also tested the website using the Azure public IP address.

## How to Use the System
**1. Access the Website**
- Open any web browser
- Type in address: http://www.sonamict171.com, You will see the Home page with 5 navigation tabs
**2. Go to Maintenance Section**
- From the navigation menu, click the Maintenance tab
- This opens the Maintenance Submission Form (login.php)
**3. User / Admin Login**
**IF YOU ARE A USER:**
- On Maintenance page, click User button
- Enter your User ID and Password
- Click Login → you will be directed to User Dashboard
  Here you can:
    - Fill in issue type, location and description
- Click Submit Report
- Your report is saved to the system
- Logout when done
  
**IF YOU ARE AN ADMIN:**
- On Maintenance page, click Admin button
- Enter your Admin ID and Password
- Click Login → you will be directed to Admin Dashboard
 Here you can:
    - View all submitted reports (date, type, location, description)
    - Delete reports once resolved
    - Manage all maintenance requests
- Logout when done

## Reference
- Electronic Frontier Foundation. (n.d.). Using Certbot for SSL/TLS certificates. Certbot Official Documentation. Retrieved 1 June 2026, from https://certbot.eff.org/docs/using.html
- Microsoft Corporation. (n.d.). Quickstart: Create a Linux virtual machine using the Azure portal. Microsoft Learn. Retrieved 1 June 2026, from https://learn.microsoft.com/en-us/azure/virtual-machines/linux/create-vm
- Namecheap Inc. (2026). Domain DNS records management guide. Namecheap Support Knowledgebase. Retrieved 1 June 2026, from https://www.namecheap.com/support/knowledgebase/article.aspx/319/2237/how-to-set-up-dns-records-for-your-domain/
- Nginx Inc. (n.d.). Nginx beginner’s guide: Installation and configuration. Nginx Documentation. Retrieved 1 June 2026, from https://nginx.org/en/docs/beginners_guide.html
- The PHP Development Team. (2026). PHP 8.3 language reference and function index. PHP Official Manual. Retrieved 1 June 2026, from https://www.php.net/docs.php
- Murdoch University. (2026). ICT171 Cloud Server Administration: Unit learning materials, lab 6: Create your cloud server.
- W3Schools. (n.d.a). CSS complete tutorial: Styling and layout techniques. Retrieved 1 June 2026, from https://www.w3schools.com/css/
- W3Schools. (n.d.b). HTML5 elements and structure guide. Retrieved 1 June 2026, from https://www.w3schools.com/html/
- W3Schools. (n.d.c). JavaScript basics and event handling. Retrieved 1 June 2026, from https://www.w3schools.com/js/
- W3Schools. (n.d.d). PHP file handling and form processing. Retrieved 1 June 2026, from https://www.w3schools.com/php/


