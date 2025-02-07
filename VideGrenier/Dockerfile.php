FROM php:8-fpm

# Installation des dépendances et de l'extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql