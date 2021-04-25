FROM ubuntu:20.04

LABEL maintainer="Kodeas"

WORKDIR /var/www/loop-dev

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y curl zip unzip git supervisor sqlite3 software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y nginx \
       php8.0-fpm php8.0-cli php8.0-mcrypt php8.0-gd php8.0-mysql \
       php8.0-mbstring php8.0-xml php8.0-curl php8.0-sqlite3 \
       php-redis \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    # Remove Lines
    && apt-get remove -y --purge software-properties-common \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    # Configure Nginx
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY nginx/default /etc/nginx/sites-available/default
COPY fpm/php-fpm.conf /etc/php/8.0/fpm/php-fpm.conf

EXPOSE 80

COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord"]