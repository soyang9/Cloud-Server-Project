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
Connection to the cloud server was completed using SSH through Windows PowerShell.
Command used:
```bash
ssh -i "C:\Users\sonam171\.ssh\Sonamstd_key.pem" azureuser@20.5.42.159
```
This command allows secure command-line access to the server for configuration and administration roles.
<img width="1205" height="763" alt="image" src="https://github.com/user-attachments/assets/f66da83d-abad-43b5-98a7-75ea0b102495" />
                            **Steps**
1. Open Terminal / PowerShell → go to folder where you saved `.pem` key
2. Copy the path.
3. Run command:
---bash
ssh -i "key.pem(folder path)" azureuser@server ip address
---
4. Now you are logged into your cloud server.
   
#### Step 3 - Installation of required Software
1. Update system
---bash
sudo apt update
---
<img width="1182" height="426" alt="image" src="https://github.com/user-attachments/assets/7101e983-e28c-411d-9c3c-3e46ef0b5f78" />

2. Install Nginx web server
---bash
sudo apt install nginx-full -y
---
<img width="758" height="140" alt="image" src="https://github.com/user-attachments/assets/cd8bfc1d-8c56-41ea-a853-05530fbf9a1d" />

3. Install PHP 8.3 to run scripts
---bash
sudo apt install php8.3 php8.3-fpm -y
---

#### Step 4 - Nginx Configutation.
1. Config file location
  ---bash
   /etc/nginx/sites-available/default
   
  



Deployment of Azure Virtual Machine
- Using Microsoft Azure, an Ubuntu Linux virtual machine was created.
- Virtual machine was configured manually to host the website and provide remote administration access through SSH.
  
#### Virtual Machine Configuration details
- Cloud provider: Microsoft Azure
- Operating system: Ubuntu Linux 24.04
- Web Server Software: Nginx
- Remote Access Method: SSH
- Public IP address: 20.5.42.159
- Domain name: www.sonamict171.com

### 2. Connecting to the Server Using SSH
Connection to the cloud server was completed using SSH through Windows PowerShell.

Command used:
```bash
ssh -i "C:\Users\sonam171\.ssh\Sonamstd_key.pem" azureuser@20.5.42.159
```
This command allows secure command-line access to the server for configuration and administration roles.

### 3. Updating the Ubuntu Server

Before installing software, package list was updated using:
```bash
sudo apt update
```

### 4. Installation of Nginx Web Server
Nginx was installed, so that i could host my website online using command:
```bash
sudo apt install nginx -y
```

### 5. Checking Nginx Status
Following command was used to check wether Nginx was running or not:
```bash
sudo systemctl status nginx
```

### 6. Website File Location
All the website files were stored in the default Nginx web directory: ```/var/www/html/ ```
The main homepage file was: index.html

I edited the homepage using: ```bash sudo nano /var/www/html/index.html ```

### 7. DNS Configuration
Domain name was connected to the public IP address of Azure using Namecheap DNS.

Domain name: 
```text
www.sonamict171.com
```
Public IP address:
```text
20.5.42.159
```
An A Record was created so that the domain name points to the Azure virtual machine.

### 8. Testing the Website
After configuring DNS, my website was tested using a web browse.

I confirmed that the website was accessible:

```text
http://www.sonamict171.com
```
I also tested the website using the Azure public IP address.

### 9. Website Development

The website was developed using:

- HTML
- CSS
- PHP

The website contains:

- Home page
- Maintenance page #reporting maintainance for the users and managing the reported issues by the admin(maintainance team)
- Server information page
- License page
- Contact Us page

### 10. Script / Code Example

Example: HTML navigation code used in the website:

```html
<a href="index.html">Home</a> |
<a href="login.php">Maintenance</a> |
<a href="server_info.html">Server Information</a> |
<a href="license.html">License</a>
<a href="contact">Contact Us</a>
```
This HTML code creates the navigation menu for the website and allows users to move between different pages of the maintenance service system.

The website was developed using HTML and CSS and php(8.3) and hosted on an Azure Ubuntu Linux virtual machine using the Nginx web server.



