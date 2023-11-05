#!/bin/bash
sudo apt-get update -y
sudo apt-get install -y apache2 git
sudo apt install -y php libapache2-mod-php 

sudo systemctl enable apache2
sudo systemctl start apache2


git clone https://github.com/shaik-rehan-uddin/php_dynamic_application.git 

sudo rm -rf /var/www/html/index.html
sudo mv php_dynamic_application/* /var/www/html

sudo chown -R www-data:www-data /var/www/html