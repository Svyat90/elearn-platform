#access
ssh root@161.35.26.83

cd /var/www/crazy

#mysql
mysql -u root -p
0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9

CREATE DATABASE IF NOT EXISTS `crazy_db` CHARACTER SET utf8 COLLATE utf8_general_ci;
SHOW DATABASES;

#allow by ip
ufw allow from 92.181.132.7 to any port 3306

#allo to connect to db
GRANT ALL PRIVILEGES ON crazy_db.* TO root@'92.181.132.7' IDENTIFIED BY '0f2afb52441efcaa47ba4b3d84675d44a03f86ad6f1e96b9';
FLUSH PRIVILEGES;

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
punem
root /var/www/crazy;

#restart nginx
service nginx restart

#some info
https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04


