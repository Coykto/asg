FROM romeoz/docker-apache-php:7.3

COPY php.ini /etc/php/7.3/cli/php.ini
# Install Xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find $(php-config --extension-dir) -name xdebug.so)" \
         > /usr/local/etc/php/conf.d/xdebug.ini