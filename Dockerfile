FROM php:8.2-apache

# ติดตั้งส่วนเสริมสำหรับเชื่อมต่อฐานข้อมูล MySQL/MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# เปิดใช้งาน mod_rewrite สำหรับ Apache 
RUN a2enmod rewrite