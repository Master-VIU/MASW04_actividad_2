# MASW04_actividad_2

### API con Laravel

Para realizar una ejecución real de la aplicación en un entorno local, basta con seguir los siguientes pasos:

- Tener instalado Composer y php en el equipo

-  Tener instalado Laravel 9 en el equipo

- Descomprimir la carpeta zip

- Instalar la carpeta vendor de Laravel
```sh
composer install
```
- Debe crear en local una base de datos con los siguientes parametros:
``` json
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=root
DB_PASSWORD=root
```
Para conectar a la base de datos se debe configurar el archivo .env, pero ese archivo no viene incluido en el .zip, asi que se debe generar. Hay dos opciones para crearlo.
*   Se puede copiar y pegar el **.env.example** que viene en el .zip en la base del proyecto y cambiar el nombre a **.env**.
*   Se cambian los datos de conexión por los datos de la base de datos que se creó en el punto anterior. Importante: Colocar el nombre de la DATABASE, el USERNAME y la PASSWORD del entorno LOCAL, luego ejecutar el siguiente comando:

```sh
php artisan key:generate
```
* O bien, puede seguir estos pasos:
1. Cree un archivo **.env** en el proyecto base
2. Copie el contenido de [.env.example](https://github.com/laravel/laravel/blob/master/.env.example/)
3. Péguelo en su archivo **.env**
4. Cambie los datos de conexiòn por los datos de la base de datos que creo en el punto anterior
5. Coloque el **USERNAME** y la **PASSWORD** de acceso a la bbdd creada en su entorno local para la conexion a bbdd.

La configuraciòn debe quedar de la siguiente manera, si no coloca la contraseña (DB_PASSWORD) va a generar error cuando ejecute el comando de las migraciones:
``` json
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=root
DB_PASSWORD=root
```
6. Luego corra el comando:
``` json
 php artisan key:generate
```

Si se tiene instalado docker, es tan sencillo como ejecutar un comando como el siguiente en una terminal para crear la base de datos localmente. Habra que tener en cuenta que los puertos no colisionen con cualquier otra maquina que se este ejecutando localmente.
```bash
docker run --name postgres -e POSTGRES_USER=root -e POSTGRES_PASSWORD=root -p 5432:5432 -d postgres
```


- Ejecutar las migraciones
```sh
php artisan migrate
```

- Ejecutar los Seeders
```sh
php artisan db:seed
```

- Arrancar el servidor
```sh
php artisan serve
```

## Postman

Para ejecutar los endpoint, debe tener instalada la herramienta Postman y siga los pasos:

- Importar la coleccion
- Crear un ENVIRONMENT con una variable llamada API, donde se introducira la URL que expone la API
  - Ejemplo: http://localhost:8000/api
- Una vez se ha creado, en postman se selecciona el entorno creado y se ejecutan las llamadas

## License

**SuperPC!**
