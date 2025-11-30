# Manual de despliegue de la aplicación


## Instalación de php, mariadb y dependencias
Primero instalamos los paquetes necesarios según los requisitos:
- php       - para procesar el código
- mariadb   - para alojar la BBDD

### 1. Actualizar el sistema
```bash
sudo apt update && sudo apt upgrade -y
```
### 2. Instalar Nginx
```bash
sudo apt install php-fpm php-mysql php-cli php-json php-zip php-curl php-xml php-mbstring mariadb-server -y
```

## Instalación de nginx completa
### 1. Actualizar el sistema
```bash
sudo apt update && sudo apt upgrade -y
```

### 2. Instalar Nginx
```bash
sudo apt install nginx -y
```

### 3. Iniciar y habilitar el servicio
```bash
sudo systemctl start nginx

sudo systemctl enable nginx
```
### 4. Comprobar estado
```bash
sudo systemctl status nginx
```
### 5. Crear certificados
La página WEB va a necesitar los certificados SSL para operar con el protocolo seguro https:
```bash
# Crear directorio para certificados
sudo mkdir -p /etc/ssl/vsgame
sudo chown root:root /etc/ssl/vsgame
sudo chmod 700 /etc/ssl/vsgame

# 1) Generar clave privada y publica para el servidor
sudo chmod 600 /etc/ssl/vsgame/vsgame.key

sudo openssl req -x509 -nodes -days 365 \
-newkey rsa:2048 \
-keyout /etc/ssl/vsgame/vsgame.key \
-out /etc/ssl/vsgame/vsgame.crt

```
### 6. Configuración básica del host virtual
```bash
sudo nano /etc/nginx/sites-available/vsgame
```
Hay que introducir la siguiente configuración:

```bash
server {
    listen 80;
    listen [::]:80;
    server_name vsgame.example.com vsgame;

    # Redirigir todo a HTTPS
    return 301 https://$host$request_uri;
}
server {
    listen 80;
    listen [::]:80;
    server_name vsgame.example.com vsgame;

    # Redirigir HTTP → HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name vsgame.example.com vsgame;

    # Certificados correctos
    ssl_certificate /etc/ssl/vsgame/vsgame.crt;
    ssl_certificate_key /etc/ssl/vsgame/vsgame.key;

    # Parámetros SSL
    include /etc/nginx/snippets/ssl-params.conf;

    # Logs
    access_log /var/log/nginx/vsgame.access.log;
    error_log  /var/log/nginx/vsgame.error.log warn;

    # Root del sitio
    root /var/www/vsgame;
    index index.php index.html index.htm;

    # Procesar PHP
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    # Seguridad básica
    location ~ /\.ht {
        deny all;
    }

    # Archivos estáticos
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### 7. Habilitar la configuración:

```bash
# Crear enlace y comprobar
sudo ln -s /etc/nginx/sites-available/vsgame /etc/nginx/sites-enabled/vsgame
```


## Alojar y configurar la BBDD

Primero importar la BBDD desde mi UBUNTU a la MV:
```bash
sudo scp -r /media/zhenyax14/SHARED/2DAW/IM/II/VSGAME/schema.sql evgenii@10.1.2.3:/evgenii/documentos
```

Ahora entramos en mariadb como root
```bash
mysql -u root -p
```

### Crear la BBDD
```sql
CREATE DATABASE vsgame
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Importar BBDD
```bash
mysql -u root -p vsgame < /home/evgenii/schema.sql
```

### Crear usuarios
```sql
-- crear usuario producción (solo desde la máquina de la app, p. ej. host_app.example.com)
CREATE USER 'prod_user'@'localhost' IDENTIFIED BY 'infierno';

-- otorgar permisos completos: operaciones CRUD para el usuario de producción 
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE
  ON vsgame.* TO 'prod_user'@'localhost';

-- crear usuario dev para el control total
CREATE USER 'dev_user'@'localhost' IDENTIFIED BY 'insoportable';

-- otorgar permisos de desarrollo (puedes ajustar):
GRANT ALL PRIVILEGES 
  ON vsgame.* TO 'dev_user'@'localhost';

-- aplicar cambios
FLUSH PRIVILEGES;
EXIT;
```

### Paso adicional:

Hay que verificar que en los ficheros .env o de configuración de la BBDD, está indicado correctamente los datos según el caso:
    
    Development:
    host: localhost
    db: vsgame
    user: dev_user
    pass: insoportable

    Producción:
    host: localhost
    db: vsgame
    user prod_user
    pass: infierno



## Alojar la app por scp

Copio el proyecto desde mi Ubuntu anfitrion a la MV:
```bash
sudo scp -r /media/zhenyax14/SHARED/2DAW/IM/II/VSGAME/ evgenii@10.1.2.3:/var/www/
```
Teniendo en cuenta toda la configuración hecha anteriormente: no hay que hacer nada más. 
La app debe procesarse sin problema

## Servidor DNS
Ahora instalamos el servidor DNS para que resuelva las solicitudes de forma natural:

    www.vsgame.com

### 1. Actualizar el sistema
```bash
sudo apt update && sudo apt upgrade -y
```
### 2. Instalar bind9
```bash
sudo apt install bind9 bind9utils bind9-doc -y
```
### 3. Habilitar el servicio
```bash
sudo systemctl enable bind9
sudo systemctl start bind9
```

Para comprobar:
```bash
sudo systemctl status bind9
```

### Configurar la zona
```bash
sudo nano /etc/bind/named.conf.local
```
Introducimos esta configuración dentro
```bash
zone "vsgame" IN {
    type master;
    file "/etc/bind/zones/db.vsgame";
};

zone "2.1.10.in-addr.arpa" {
    type master;
    file "/etc/bind/zones/db.inversa";
};

```
Creamos el directorio para archivos de la zona
```bash
sudo mkdir -p /etc/bind/zones
```
### Zona directa
```bash
sudo nano /etc/bind/zones/db.vsgame
```

```bash
$TTL 86400
@   IN  SOA ns1.vsgame. eugkan.alu.edu.gva.es (
        20250101 ; Serial
        3600      ; Refresh
        1800      ; Retry
        604800    ; Expire
        86400 )   ; Minimum

; Servidores DNS
    IN  NS  ns1.vsgame.

; Registros A
ns1     IN  A   10.1.2.4
www     IN  A   10.1.2.3
vsgame  IN  A   10.1.2.3

```

### Zona inversa
```bash
sudo nano /etc/bind/zones/db.inversa
```
Ponemos este contenido:
```bash
$TTL 86400
@   IN  SOA ns1.vsgame. eugkan.alu.edu.gva.es (
        20250101
        3600
        1800
        604800
        86400 )

    IN  NS  ns1.vsgame.

3  IN  PTR ns1.vsgame.
4  IN  PTR vsgame.

```

### Verificar la configuración
Comprobación general de sintáxis
```bash
sudo named-checkconf
```

Comprobación de cada fichero
```bash
sudo named-checkzone vsgame /etc/bind/zones/db.vsgame
sudo named-checkzone 2.1.10.in-addr.arpa /etc/bind/zones/db.inversa
```
Reiniciamos
```bash
sudo systemctl restart bind9
```

## Ajustes adicionales
En la MV, donde está instalado Debian debemos modificar el fichero resolv.conf
```bash
sudo nano /etc/resolv.conf
```

Introducimos:

```bash
nameserver 192.168.1.10
```


## Conclusión

El despliegue está finalizado

