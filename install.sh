#!/bin/bash

echo "### Conecatando no container...";
docker exec -it -d workspace bash
echo "### Conectado";
echo "### Rodando composer install...";
composer install
echo "### Composer instal OK";
echo "### Rodando migrate...";
php artisan migrate
echo "### Migrate OK";
echo "### Rodadndo seeds...";
/usr/local/bin/php artisan db:seed
echo "### Seeds OK";
echo "### Gerando chave app...";
php artisan key:generate
echo "### Chave OK";
echo "### Desconectando do container";
exit
echo "### Desconectado";
