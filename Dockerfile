FROM ubuntu:18.04
MAINTAINER purvesh <ind.purvesh@gmail.com>

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
 apache2-bin \
 libapache2-mod-php \
 php-ctype \
 php-curl \
 php-gd \
 php-json \
 php-ldap \
 php-mbstring \
 php-mysql \
 php-sqlite3 \
 php-tokenizer \
 php-xml \
 curl \
 git \
 mysql-client \
 nano \
 patch \
 unzip \
 vim

RUN cd /tmp;curl -sS https://getcomposer.org/installer | php;mv /tmp/composer.phar /usr/local/bin/composer

RUN rm -rf /var/www/laravel

RUN composer create-project avored/laravel-ecommerce /var/www/laravel

RUN /bin/chown www-data:www-data -R /var/www/laravel/storage

ADD 000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite

RUN service apache2 start

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
