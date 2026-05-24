# Server Setup Documentation

## 1. Creating the Azure Virtual Machine

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

Example command:

```bash
ssh -i "C:\Users\sonam171\.ssh\Sonamstd_key.pem" azureuser@20.5.42.159


## 3. Updating the Ubuntu Server

After logging into the server, I updated the package list using:

```bash
sudo apt update


## STEP 4: Add Nginx installation

Paste this:

```markdown
## 4. Installing Nginx Web Server

I installed Nginx to host my website online.

```bash
sudo apt install nginx -y


## STEP 5: Add Nginx check

Paste this:

```markdown
## 5. Checking Nginx Status

I checked that Nginx was running using:

```bash
sudo systemctl status nginx


## STEP 6: Add website file location

Paste this:

```markdown
## 6. Website File Location

The website files were stored in the default Nginx web directory:

```bash
/var/www/html/

