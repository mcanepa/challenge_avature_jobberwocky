<p align="center">
	<img src="https://www.avature.net/wp-content/themes/avature/img/avature-2.svg" alt="" height="75">
</p>

## Avature

Challenge para demostrar por qué deben contratarme =)

A continuación las instrucciones para poder instalar y correr el proyecto...

## Antes de comenzar...

Asegurate de tener instalado git, composer y php >= 8.2

## Paso 1: Clonar el repo

Abrir una consola y ejecutar

```
git clone https://github.com/mcanepa/challenge_avature_jobberwocky
```

Luego entrar al directorio

```
cd challenge_avature_jobberwocky
```

## Paso 2: Instalar proyecto y dependencias

Ya dentro del directorio ejecutamos:

```
composer install
```

Y dejamos que composer haga su magia

## Paso 3: Archivo de entorno

Para fines pŕacticos, en el raíz del proyecto ya existe un archivo ```.env``` para poder usar la aplicación.

## Paso 4: Crear base de datos, tablas y fixtures (SQLITE)

Ejecutar

```
php bin/console doctrine:schema:create
```

Luego ejecuta los fixtures para tener algunos datos de prueba

```
php bin/console doctrine:fixtures:load
```

## Paso 5: Correr el proyecto

Ejecuta

```
symfony server:start
```

(si no tienes ese comando, sigue [estas instrucciones](https://symfony.com/download))

Eso deja corriendo el proyecto en http://127.0.0.1:8000

Ahora que la API está online, puedes probarla con la interfaz gráfica que viene en este proyecto.

Allí podrás registrar un nuevo usuario, hacer login, ver un listado de registros y tendrás la posibilidad de crear más y actualizarlos!!

## Notas finales

Los endpoints de la API son:

```
http://127.0.0.1:8000/companies
http://127.0.0.1:8000/users
http://127.0.0.1:8000/jobs
```

Ejemplos de payload de POST para cada una

Companies:
```
{
	"name": "Avature"
}
```

Users:
```
{
	"name": "John Doe",
	"email": "jdoe@gmail.com",
	"password": "12345",
	"company": "/companies/1"
}
```

Jobs:
```
{
    "name": "Awesome job!",
    "salary": 100000,
    "country": "Argentina",
    "skills": [
        "html",
        "css",
        "javascript"
    ],
    "user": "/users/1"
}
```


Puedes testearlos con la UI provista o mediante algun programa como Postman

Hay un endpoint GET que muestra tanto las oportunidades internas como las de jobberwocky.

Pero para que estén disponibles, hay que seguir estas [instrucciones](https://github.com/avatureta/jobberwocky-extra-source).

Siguiéndolas y utilizando node, el servicio jobberwocky queda disponible en [http://127.0.0.1:8080/jobs](http://127.0.0.1:8080/jobs)

Entonces, para poder ver todas las oportunidades, hay que ir a

```
http://127.0.0.1:8000/search
```

Algunos posibles filtros son:

```
http://127.0.0.1:8000/search?country=Argentina
http://127.0.0.1:8000/search?name=dev
http://127.0.0.1:8000/search?name=dev&country=Argentina
http://127.0.0.1:8000/search?salary[gte]=30000&country=Argentina
http://127.0.0.1:8000/search?salary[gte]=30000&salary[lte]=40000
```

## Saludos
Aguardo feedback y estamos en contacto!
