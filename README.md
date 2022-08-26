# codigos_zip
1- Solo compatible con versiones de PHP 8
2- Realizar el clone del repositorio
3- Correr composer install
4- Configurar archivo .env para conexion a la base de datos
6- Realizar el apuntamiento de peticiones del servidor Web a public/index.php
7- Cargar el archivo sql/codigos_postales.sql
8- Cargar el archivo, despues de descomprimir sql/codigos.zip
9- Realizar peticiones tipo GET al endpoint http://{servidor-web}/api/zip-codes/{zip-codes}


Se aborda el mejoramiento del tiempo de la respuesta creando una unica tabla, con un la creacion de un indice sobre la columna d_codigo; adicional se crea un procedimiento que ejecuta los selects de mejor forma, si esta informacion fueran varias tablas y se requirieran unir. Lamentablemente no todos los web hosting son compatibles, con este tipo de ejecuciones por lo que hay que tener en cuenta el definidor del procedimiento o crearlo manualmente.
