FROM php:7.4-cli
COPY . /var/www/tui-app
WORKDIR /var/www/tui-app
CMD [ "php", "-a" ]