# Library
1. Восстановить дамп бд;
2. composer install
3. Редактировать .env;


Для запуска можно воспользоваться:

http://nikolaev-web.ru/blog/installing_the_composer_on_openServer/

https://ospanel.io/forum/viewtopic.php?t=4816

return array (
  'APP_ENV' => 'prod',
  'APP_SECRET' => '8637be2769e18be5bf7bccfa1a91c62a',
  'DATABASE_URL' => 'pgsql://postgres:@127.0.0.1:5432/db_books?serverVersion=5.7',
);


Команды для работы с postgres в OSPanel:

createdb.exe --username=postgres db_laws

pg_dump.exe --username=postgres db_laws > dump_laws.sql

psql --dbname=db_laws --quiet --file="C:\OSPanel\domains\2\dump_laws.sql" --username=postgres >nul