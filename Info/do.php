#access
ssh root@161.35.26.83
cd /var/www/crazy

#restart services
service nginx restart
systemctl status nginx

service mysql restart
systemctl status  mysql

service php7.2-fpm restart
systemctl status php7.2-fpm