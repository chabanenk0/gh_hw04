GeekHub experience (TestAssignmentBundle for performing quizzes)

This project contains a bundle for a quiz.
Every quiz have a number of questions, each have answers. 
The answers are evaluated by number of scales. Each answer 
influences differently to each of the scale. 

You can use two types of questions: one-case (with a possibility to 
choose only one answer) ans multicase (it is possible to chose many 
answers)

Every attemt to pass the quiz is recorded, the researcher can develop
own statistical analysis algorithms to the results.

... to be continued.

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

1) tests routing point: /tests (displays test list)

2) testview routing point: /testview/{id} (displays a test with the given id (use without {}))

3) new user routing point: /newuser registers new user

4) new test routing point: /newtest registers new test
