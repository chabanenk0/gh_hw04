My first symfony2 experiment.

-----------
Installation notes:
1) update vendors: In this directory type from console:

composer update

2) Add your virtual host to Your /etc/hosts file. Add a new line to this file, for example:

127.0.0.1 sf2.local

3) Add virtual host to Your apache2 configuration. Edit a file /etc/apache2/sites-available/default and add the following lines:

<VirtualHost *:80>
<Directory "/$data_dir/symfony/web/sf">
 AllowOverride All
 Allow from All
</Directory>
  ServerName sf2.local
  DocumentRoot "/var/www/Symfony/web"
  DirectoryIndex index.php
  Alias /sf /$data_dir/symfony/web/sf

  Alias /myapp/ /var/www/Symfony/web/
  <Directory "/var/www/Symfony/web">
   AllowOverride All
   Allow from All
  </Directory>
</VirtualHost>


---------
Usage:

0) initial routing point: / (displays a welcome page)

1) first routing point: /first (displays a simple Responce object)

2) Second routing point: /second (displays th

You can edit the template's content in the file: ???.html.twig

3) Third routing point: /third (displays the template, that extenses the BASE template)

