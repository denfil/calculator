FROM alpine

RUN apk add --no-cache \
        php7 \
        php7-dom \
        php7-json \
        php7-mbstring \
        php7-openssl \
        php7-phar \
        php7-tokenizer \
        php7-xdebug \
        php7-xml \
        php7-xmlwriter \
        php7-zlib \
    && wget -qO - https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN sed -i -r \
        -e "s/(error_reporting = E_ALL) & ~E_DEPRECATED & ~E_STRICT/\1/g" \
        -e "s/(display_errors =) Off/\1 On/g" \
        -e "s/(display_startup_errors =) Off/\1 On/g" \
        /etc/php7/php.ini \
    && sed -i -r \
        -e "s/;(zend_extension=xdebug.so)/\1/g" \
        /etc/php7/conf.d/xdebug.ini

VOLUME /var/www

WORKDIR /var/www

CMD composer update ; composer test
