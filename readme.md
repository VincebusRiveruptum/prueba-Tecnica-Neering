# Prueba Técnica Neering

El repositorio cuenta con dos proyectos, una para el front-end y otra para el back-end.

# Información técnica:

* Backend: 
	- Es una API Rest
	- Desarrollado con Laravel 10.48.4
	- PHP 8.1.10
	- Auth con Laravel Breeze y Sanctum mediante Bearer Token
	
* Frontend
	- Es una app SPA
	- Node 18.8.0
	- NPM 8.18
	- Vue 3
	- Pinia
	- Axios para el consumo de api
	- Tailwindcss para el estilo


# Manual de instalación

Desarrollado bajo el entorno de Laragon en Windows 11, asumiendo que se utiliza Laragon o un entorno Ubuntu con Apache, Laravel, Composer y MySQL hay que seguir los siguientes pasos.

* Clonamos el repositorio en la carpeta /www

> git clone https://github.com/VincebusRiveruptum/prueba-Tecnica-Neering.git



# Instalación del back-end

- Primero hay que asegurarse que todos los servicios esten ejecutandose,

- Solo laragon: Copiar el respositorio en la carpeta www en la carpeta donde se ubica Laragon, luego abrir el menu principal de Laragon e iniciar todos los servicios con "Start All"

- Vamos a la dirección "prueba-Tecnica-Neering"
no
> composer install

> php artisan migrate --seed

> php artisan serve

# Instalación del front-end

* Vamos a la dirección "product-finder-client"

> npm i

> npm run dev

# Notas

* En mi equipo se uso la dirección localhost:8000 para el servidor y localhost:5173 para el cliente
* En en la carpeta "product-finder-server" verificar existencia del archivo .env, y verificar DB_NAME=laravel

# Lista de tareas

* Lista de tareas cumplidas y faltantes.

* TODO:

- Back end			 											
	- CORREGIR INCONSISTENCIA ENTRE VALIDATION REQUEST POR CLASE Y POR CONTROLADOR EN PRODUCTCONTROLLER
- Front	
	- Login - OK
	- Register - OK
	- ruta main
		- Topnavbar
		- menu desplegable	
			- Cerrar sesión			
			- Redireccionamiento
			- Configuración usuario
		- Barra lateral
			- Navegador											OK
				
	- Productos
		- Vista general 											OK
		- Paginacion												OK
		- Agregar													OK
		- Eliminar													OK
			- Almacenar fotos de productos		
		- Modificar
		- Filtrado													OK
			- Tipo													OK
				- Hay stock											OK
				- No hay stock										OK
		- Barra de busqueda											OK
		- ARREGLAR ESTETICA TABLAS
			- ARREGLAR ITEMS
	- Usuarios
		- Vista general												OK
			- PAGINACION											OK
				- Control de paginación								OK
					- BLOQUEAR CONTROLES DE NAVEGACION CONSUMO		OK
					- MEJORAR ESTETICA	
			- Modal Agregar usuario									OK
				- Informar estado de peticion						OK
				- Almacenar foto de perfil
			- Modal eliminar usuario								OK
			- Filtrado												OK
				- Usuarios activos									OK
				- Usuarios inactivos								OK
	- RESPONSIVIDAD
	- SEEDING														OK
	- ARREGLAR RUTAS												OK
		- HOME														OK
	- STORE DE PINIA												OK
		- Solo mantener el de el usuario							OK
	- CERRAR SESIÓN
