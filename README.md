[Wiki des Maires](http://wikidesmaires.amrf.fr)
=========

![test](https://github.com/favicon.ico){:height="24px" width="48px"}

Project [Wild Code School](https://wildcodeschool.fr/) for [Association des Maires Ruraux de France](http://www.amrf.fr/). 

## Instructions :
  * Create a website gathering resources about projects development for cities of less of 3500 inh.
  * 2 types of resources : projects descriptions with contacts and list of partners of AMRF.
  * The graphic chart is not yet defined. For now, only the logo's colors chart must be followed.
 
## Technologies used :

* Css3, html5
* Scss / Sass   
* Bootstrap 3.4      
* Javascript / jQuery
* Symfony 3.4
* PHP 7.1 :  

## Installation :
* create your user (never use root)

        sudo adduser <userName>
    
* add new user to sudo group

        sudo adduser <userName> sudo
          
* install git, php7.1, php-mbstring, php-cli, php-xml, apache2, mysql, curl, unzip from distribution

* install GD library 

        sudo apt-get install php-gd 

* install composer : 

         cd~ 
         curl -sS https://getcomposer.org/installer -o composer-setup.php
         sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    
* create directories 
            
        /data/www, /data/log/apache2, /data/log/mysql
* change permissions for apache2 and mysql directories
* change target file for mysql error log : 

        edit /etc/mysql/mysql.conf.d/mysqld.cnf

* find an change line log_error
    
        log_error = /data/log/mysql/error.log

* restart mysql server
* create vhost for apache2 in /etc/apache2/site-availables : amrf.conf (http)  
    
      <VirtualHost *:80>
      ServerName wikidesmaires.amrf.fr
      ServerAlias www.wikidesmaires.amrf.fr
      DocumentRoot /data/www//web
      <Directory /data/www/Lyon-0917-AMRF/web>
      Require all granted
      AllowOverride All
      <IfModule mod_rewrite.c>
      Options -MultiViews
      RewriteEngine On
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteRule ^(.*)$ app.php [QSA,L]
      </IfModule>
      </Directory>
      ErrorLog /data/log/apache2/amrf_error.log
      CustomLog /data/log/apache2/amrf_access.log combined
      </VirtualHost>
    
* Activate your vhost
  
        sudo a2ensite amrf.conf
  
* add environment variable for symfony
  
        SYMFONY_ENV=prod (edit /etc/environment)
  
* export environment variable : 
        
        export SYMFONY_ENV=prod
* go to /data/web clone the repository
  
* git clone https://github.com/WildCodeSchool/Lyon-0917-AMRF.git
  
* set file permissions permanently
  
        sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX var
        sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX var
  
* Install vendor and configure parameters
  
        composer install --no-dev --optimize-autoloader
  
* Create or import your database

        php bin/console doctrine:database:create
        php bin/console doctrine:shema:update --force
        mysql -u <login> -p amrf < Amrf.sql
 
* active apache2 rewrite module  
       
        sudo a2enmode rewirte
        
* restart apache2 server 

        sudo /etc/init.d/apache2 restart

     
## Period : 
#### 2 phases : 
1. weeks phase for front-end development (until 11/15) 
2. 6 weeks phase for back-end development 
         
 
## Development Team : 
**[Marie](https://github.com/m4rthiz), [Darin](https://github.com/mateevd), [Simon](https://github.com/syneot), [Jeremy](https://github.com/Cerynna), [Severine](https://github.com/Cverine)**

>A Symfony project created on October 20, 2017, 11:25 am.
