# ICT171 Cloud Server Project: Cloud-based Maintenance Service System

**Student Name:** Sonam Yangchen
**Student ID:** 35867346

### Website Links
**Public IP Address:** http://20.5.42.159
**Domain Name:** www.sonamict171.com

## 1. Project Overview
- This project is a Cloud-based Maintenance Service System hosted using Microsoft Azure where users can submit maintenance issues online, example: broken lights, AC repair or any other maintenance isuues.
- It focuses on cloud deployment and infrastracture as a service(IaaS).

## 2. Technologies Used
- Microsoft Azure
- Ubuntu Linux
- Nginx Web Server
- HTML
- CSS
- PHP 8.3
- DNS / Domain Configuration (Namecheap)
- GitHub

## Server Setup
### 1. Creating the Azure Virtual Machine

I created a cloud server using Microsoft Azure Infrastructure as a Service (IaaS).  
The server was created as an Ubuntu Linux virtual machine.

Server details:
- Cloud provider: Microsoft Azure
- Operating system: Ubuntu Linux 24.04
- Server type: Virtual Machine
- Public IP address: 20.5.42.159
- Domain name: www.sonamict171.com

## 2. Connecting to the Server Using SSH

After creating the virtual machine, I connected to the server using SSH from Windows PowerShell.

Command:
```bash
ssh -i "C:\Users\sonam171\.ssh\Sonamstd_key.pem" azureuser@20.5.42.159
```

## 3. Updating the Ubuntu Server

After logging into the server, I updated the package list using:
```bash
sudo apt update
```

## 4: Add Nginx installation, Installing Nginx Web Server
I installed Nginx to host my website online using:
```bash
sudo apt install nginx -y
```

### 5. Checking Nginx Status

I checked that Nginx was running using:
```bash
sudo systemctl status nginx
```

## STEP 6: Add website file location, Website File Location
The website files were stored in the default Nginx web directory: ```/var/www/html/ ```
The main homepage file was: index.html

I edited the homepage using: ```bash sudo nano /var/www/html/index.html ```

## 7. DNS Configuration

I connected my domain name to the Azure public IP address using Namecheap DNS settings.

Domain name:

```text
www.sonamict171.com
```
Public IP address:
```text
20.5.42.159
```
An A Record was created so that the domain name points to the Azure virtual machine.

## 8. Testing the Website
After configuring DNS, I tested the website using a web browser.

I confirmed that the website was accessible:

```text
http://www.sonamict171.com
```
I also tested the website using the Azure public IP address.

## 9. Website Development

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

## 10. Script / Code Example

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



