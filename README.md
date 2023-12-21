## 🦕

php bin/console make:controller nomDuController
php bin/console make:entity nomDeEntite
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
php bin/console make:fixture nomDeFixture
php bin/console doctrine:fixtures:load
php bin/console security:hash-password

admin login     : root@gmail.com
admin password  : root