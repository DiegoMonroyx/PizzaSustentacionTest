FROM node:18

WORKDIR /app

# Copiar package.json y package-lock.json para aprovechar caché
COPY package*.json ./

# Instalar dependencias del proyecto localmente
RUN npm install

# Instalar Angular CLI globalmente
RUN npm install -g @angular/cli

# Copiar todo el código fuente
COPY . .

# Construir la app Angular para producción
RUN npm run  

# Exponer el puerto por defecto Angular usa en dev server (opcional)
EXPOSE 4200

# Comando para correr la app (puede ser ng serve o npm start según tu package.json)
CMD ["npm", "run", "start"]