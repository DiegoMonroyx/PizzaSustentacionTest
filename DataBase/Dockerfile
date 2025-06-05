# Usa la imagen base oficial de MariaDB
FROM mariadb:10.5

# Permite cambiar el archivo SQL al construir (por defecto: pizzapaisa.sql)
ARG SQL_FILE=pizzapaisa.sql

# Copia el archivo SQL al directorio de inicialización
COPY ${SQL_FILE} /docker-entrypoint-initdb.d/