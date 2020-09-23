#### Install Dependencies
```
sudo apt update && sudo apt install default-jre
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | sudo tee /etc/apt/sources.list.d/elastic-7.x.list
sudo apt-get install elasticsearch
sudo service elasticsearch start
sudo update-rc.d elasticsearch defaults 95 10 // for auto start
sudo apt-get install -y xpdf
```
#### Copy And Set Settings
```bash
cp .env-example .env
```
#### Set Permissions
```bash
chmod 755 /var/www/html 
chmod 755 /var/www/html/public
chmod 644 /var/www/html/public/index.php 
chmod -R 777 /var/www/html/storage 
chmod -R 777 /var/www/html/bootstrap/cache
```
#### Run Commands:
```bash
composer install
php artisan migrate --seed
php artisan storage:link
php artisan key:generate
php artisan config:cache
```
