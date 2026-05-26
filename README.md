# ICT171 Cloud Server Project: Cloud-based Maintenance Service System

**Student Name:** Sonam Yangchen
**Student ID:** 35867346

### Website Links
**Public IP Address:** http://20.5.42.159
**Domain Name:** www.sonamict171.com

## Project Overview
- This project is a Cloud-based Maintenance Service System hosted using Microsoft Azure where users can submit maintenance issues online, example: broken lights, AC repair or any other maintenance isuues.
- It focuses on cloud deployment and infrastracture as a service(IaaS).

##  Technologies Used
- Microsoft Azure
- Ubuntu Linux
- Nginx Web Server
- HTML
- CSS
- PHP 8.3
- DNS / Domain Configuration (Namecheap)
- GitHub

## Server Setup
### 1. Deployment of Azure Virtual Machine
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

### 4: Add Nginx installation, Installing Nginx Web Server
Nginx was installed, so that i could host my website online using command:
```bash
sudo apt install nginx -y
```

### 5. Checking Nginx Status
Following command was used to check wether Nginx was running or not:
```bash
sudo systemctl status nginx
```

### STEP 6: Website File Location
All the website files were stored in the default Nginx web directory: ```/var/www/html/ ```
The main homepage file was: index.html

I edited the homepage using: ```bash sudo nano /var/www/html/index.html ```

## 7. DNS Configuration
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



