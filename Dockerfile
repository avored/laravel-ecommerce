FROM indpurvesh/laravel-ecommerce
MAINTAINER purvesh <ind.purvesh@gmail.com>


RUN apt-get update && apt-get install -y \
 apache2-bin \
 libapache2-mod-php5 \
 php5-curl \
 php5-ldap \
 php5-sqlite \
 php5-mysql \
 php5-mcrypt \
 php5-gd \
 patch \
 curl \
 nano \
 vim \
 git \
 mysql-client



RUN rm /etc/apache2/sites-available/000-default.conf

ADD 000-default.conf /etc/apache2/sites-available/

RUN service apache2 start

RUN cd /tmp;curl -sS https://getcomposer.org/installer | php;mv /tmp/composer.phar /usr/local/bin/composer

Run rm -rf /var/www/laravel

RUN composer create-project mage2/laravel-ecommerce /var/www/laravel

RUN /bin/chown www-data:www-data -R /var/www/laravel/storage

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
