Play With Symfony
===========

A Symfony project created on December 19, 2016, 12:33 am.

This project is based on the 3.2 version of Symfony.

First commit on December 20, 2016.

This project is just for fun.

I have implemented those bundles:
- friendsofsymfony/rest-bundle: "^2.1"
- jms/serializer-bundle: "^1.1"
- friendsofsymfony/user-bundle: "~2.0@dev"
- friendsofsymfony/elastica-bundle: "^3.2"
- hautelook/alice-bundle: "^1.4"
- doctrine/data-fixtures: "^1.2"


* Code to add virtual hosts (with apache) :
<VirtualHost *:80>
    ServerName www.playwithsymfony.com
    DocumentRoot "/var/www/html/play-with-symfony/web/app.php"

    ErrorLog ${APACHE_LOG_DIR}/error_www_playwithsymfony.log
    CustomLog ${APACHE_LOG_DIR}/access_www_playwithsymfony.log combined

    # Other directives here
</VirtualHost>

<VirtualHost *:80>
    ServerName www2.playwithsymfony.com
    DocumentRoot "/var/www/html/play-with-symfony/web/app_dev.php"

    ErrorLog ${APACHE_LOG_DIR}/error_www2_playwithsymfony.log
    CustomLog ${APACHE_LOG_DIR}/access_www2_playwithsymfony.log combined

    # Other directives here
</VirtualHost>


* Code to add to add hosts to /etc/hosts:
127.0.0.1 www.playwithsymfony.com
127.0.0.1 www2.playwithsymfony.com
