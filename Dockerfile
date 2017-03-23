FROM indpurvesh/laravel-ecommerce
MAINTAINER purvesh <ind.purvesh@gmail.com>


RUN apt-get update -y && \
    apt-get install -y curl git php5-mcrypt php5-gd && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer self-update && \
    apt-get remove --purge curl -y && \
    apt-get clean


RUN /usr/sbin/a2enmod rewrite

ADD 000-laravel.conf /etc/apache2/sites-available/

RUN service apache2 start

RUN cd /tmp;curl -sS https://getcomposer.org/installer | php;mv /tmp/composer.phar /usr/local/bin/composer

RUN composer create-project mage2/laravel-ecommerce /var/www/laravel

RUN /bin/chown www-data:www-data -R /var/www/laravel/storage

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
