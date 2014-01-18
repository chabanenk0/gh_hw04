<?php

// composer install

// you should give ownership to these folders to your user:
// sudo chown -R group:chabanenk0 ../app/cache/
// sudo chown -R group:chabanenk0 ../app/logs/
// sudo chown -R group:chabanenk0 ../web/bundles/acmedemo/images/

system("chmod -R 777 ../app/cache");
system("chmod -R 777 ../app/logs");
system("chmod -R 777 ../web/bundles/acmedemo/images/");

system("../app/console doctrine:database:create");

system("../app/console doctrine:schema:create");

system("../app/console doctrine:fixtures:load");
