#!/bin/bash

apt-get update
apt-get install -y vim git curl wget unzip

apt-get install -y apt-transport-https lsb-release ca-certificates
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg

sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'

apt-get update
apt-get install -y mysql-server nginx php-fpm php-mysql php-curl php-json php-gd php-intl php-mbstring php-redis php-xml php-zip php-bcmath

[ ! -e /etc/nginx/sites-enabled/default ] || rm /etc/nginx/sites-enabled/default
cp /vagrant/vagrant/symfony.conf /etc/nginx/sites-enabled
sudo service nginx restart

cd /tmp
wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

echo "update user set plugin='' where User='root';"|mysql -uroot mysql
echo "flush privileges;"|mysql -uroot mysql
