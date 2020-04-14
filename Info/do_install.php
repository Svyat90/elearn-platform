<?php
// http://161.35.26.83/
?>
#access
ssh root@161.35.26.83

cd /var/www/crazy

#mysql
mysql -u root -p
0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9

CREATE DATABASE IF NOT EXISTS `crazy_db` CHARACTER SET utf8 COLLATE utf8_general_ci;
SHOW DATABASES;

#cream user nou
CREATE USER 'crazy_user'@'localhost' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9';
GRANT USAGE ON *.* TO 'crazy_user'@'localhost' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
FLUSH PRIVILEGES;

#dam acces pentru usr nou
GRANT ALL PRIVILEGES ON crazy_db.* TO crazy_user@'92.181.132.7' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9';
FLUSH PRIVILEGES;

#allow by ip
ufw allow from 92.181.132.7 to any port 3306

#allo to connect to db
GRANT ALL PRIVILEGES ON crazy_db.* TO root@'92.181.132.7' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9';
FLUSH PRIVILEGES;

GRANT ALL PRIVILEGES ON crazy_db.* TO root@'localhost' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9';
FLUSH PRIVILEGES;

#IMPORTANT IMPORTANT daca nu este acces terbuie asta de pus
GRANT ALL PRIVILEGES ON crazy_db.* TO 'crazy_user'@'localhost';
#lista
SELECT User,Host,authentication_string,plugin FROM mysql.user;

#mysql.cnf trebuie de pus bind = 00000
nano /etc/mysql/mysql.conf.d/mysqld.cnf
0.0.0.0  //
si cind e connecat sa nu fie selectat ssh la sequlpro dar primul

#restart mysql
service mysql restart

#config nginx ca sa vadar siteul
cd /etc/nginx/sites-available
editam fisierul digitalocean
#punem
root /var/www/crazy/public;
#facem replace cu asta
location ~ \.php$ {
try_files $uri /index.php =404;
fastcgi_split_path_info ^(.+\.php)(/.+)\$;
fastcgi_pass unix:/run/php/php7.2-fpm.sock;
fastcgi_index index.php;
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
include fastcgi_params;
fastcgi_read_timeout 300;
}


#restart nginx
service nginx restart

#copy project to server la sfirsit punem numa la mapa care dorim sa fie
git clone https://github.com/ghena85/Crazy-Tech.git crazy

#--- list of errof composer update
#configuram sa porneasca proiectul
apt install composer
compser update

#fixing error mmap() failed: [12] Cannot allocate memory

rm -rf vendor/
rm -rf composer.lock
php composer install

#create swap memory
sudo fallocate -l 1G /swapfile
ls -lh /swapfile
https://www.digitalocean.com/community/tutorials/how-to-add-swap-space-on-ubuntu-16-04

sudo apt-get install php-mbstring
sudo apt-get install php7.2-mbstring

sudo apt-get install php7.2-xml

sudo apt-get install php7.1-gd

#--- list of errof composer install

sudo chmod 777 -R  /var/www/crazy/storage
sudo chmod -R 777 bootstrap

php artisan key:generate

#instalma ffmpem
sudo add-apt-repository ppa:mc3man/trusty-media
sudo apt-get update
sudo apt-get install ffmpeg
sudo apt-get install frei0r-plugins

#change max upload = php.ini
/etc/php/7.2/fpm
upload_max_filesize = 1000M
post_max_size = 58M

#some info
https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04




