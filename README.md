# Ceiboo zip-codes
Proyecto de Investigación

### Instalación ###
* `git clone git@github.com:Ceiboo/zipcodes.git`
* `cd zipcodes`
* `docker-compose build main`
* `docker-compose up -d`
* `docker-compose exec main composer update`
* `docker-compose exec main php artisan key generate`

### Para tener acceso al endpoint del docker a la app ###
En tu archivo /etc/hosts incluir las siguientes lineas
* `127.0.0.1 api.ceiboo.jla`

- Test de instalación en navegador:
* `http://api.ceiboo.jla/api/status`

### Importar datos de correo ###
* `docker-compose exec main php artisan migrate:fresh`
* `docker-compose exec main php artisan api:import`
* `docker-compose exec main php artisan api:query`

### Otros comandos ###
Para bajar los dockers
* `docker-compose down`
