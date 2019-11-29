FROM phpdockerio/php71-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php-memcached php7.1-dev php7.1-common php7.1-mysql php-redis php-xdebug php7.1-gd php-imagick php7.1-imap php-mongodb php7.1-soap php7.1-bcmath \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN chown -R 1000:1000 /var/lib/php/sessions