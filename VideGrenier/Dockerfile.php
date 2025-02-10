# Utilise l'image officielle PHP version 8 avec FPM (FastCGI Process Manager)
FROM php:8-fpm

# Installation des dépendances et de l'extension PDO MySQL
# RUN exécute des commandes dans le conteneur
RUN docker-php-ext-install pdo pdo_mysql
# Installe les extensions PHP PDO et PDO MySQL nécessaires pour interagir avec une base de données MySQL