Prueba Técnica Neering

* Backend: 

	- Es una API Rest
	- Usa laravel 10.48.4
	- Usa laravel Breeze con Sanctum
		- Auth con cookie
* Frontend
	- Vue
	- Pinia
	- Tailwindcss
	- Axios

rutas front:
	localhost:5174/
	localhost:5174/users
	localhost:5174/products

npx tailwindcss -i ./src/assets/main.css -o ./src/assets/main-output.css --watch

TODO:
	- Back end			: OK
		- CORREGIR INCONSISTENCIA ENTRE VALIDATION REQUEST POR CLASE Y POR CONTROLADOR EN 			PRODUCTCONTROLLER
	- Front	
		- Login			OK
		- Register		OK
	- Main
		- Topnavbar
			- Cerrar sesión			
				- Redireccionamiento
			- Configuración usuario
		- Barra lateral
			- Navegador
	- Productos
		- Vista general 				OK
		- Paginacion					OK
		- Agregar					OK
		- Eliminar					OK
			- Almacenar fotos de productos		
		- Modificar
		- Filtrado					OK
			- Tipo
				- Hay stock			OK
				- No hay stock			OK
		- Barra de busqueda				OK
		- ARREGLAR TAMAÑO DE TABLA
			- ARREGLAR ITEMS
	- Usuarios
		- Vista general					OK
			- PAGINACION				OK
				- Control de paginación
					- BLOQUEAR CONTROLES DE NAVEGACION AL SOLICITAR
					- MEJORAR ESTETICA	OK
			- Modal Agregar usuario			OK
				- Informar estado de peticion
				- Almacenar foto de perfil
			- Modal eliminar usuario		OK
			- Filtrado				OK
				- Usuarios activos		OK
				- Usuarios inactivos		OK
	- RESPONSIVIDAD
	- SEEDING						OK
	- ARREGLAR RUTAS					OK
		- HOME
	- BORRAR STORE DE PINIA					OK
		- Solo mantener el de el usuario		OK
	- CERRAR SESIÓN

