FROM php:7.4-cli

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt -y update
RUN apt -y install git zip unzip

COPY . /var/www/tui-app
WORKDIR /var/www/tui-app

CMD [ "php", "-a" ]