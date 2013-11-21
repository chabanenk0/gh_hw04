My first symfony2 experiment.

-----------
Installation notes:
1) update vendors: In this directory type from console:

composer update

2) Add your virtual host to Your /etc/hosts file. Add a new line to this file, for example:

127.0.0.1 sf2.local

3) Add virtual host to Your apache2 configuration. Edit a file /etc/apache2/sites-available/default and add the following lines:

<plaintext>
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
</plaintext>

4) Nodify the file app/config/parameters.yml, set up Your database's settings

5) run
app/console doctrine:database:create

6) run 
app/console doctrine:fixtures:load

---------
Usage:

0) initial routing point: / (displays a welcome page)

1) first routing point: /first (displays a simple Responce object)

2) Second routing point: /second (displays the simple template: html)

You can edit the template's content in the file: src/Acme/DemoBundle/Resources/views/My/second.html.twig

3) Third routing point: /third (displays the template, that extenses the BASE template)

You can edit the template's content in the file: src/Acme/DemoBundle/Resources/views/My/third.html.twig


