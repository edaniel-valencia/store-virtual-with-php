<p align="right">
  <a href="README.md">🇪🇸 Español</a> ·
  <a href="README.en.md">🇬🇧 English</a>
</p>

<p align="center">
  <img src="public/img/logo-adavam.png" alt="ADAVAM" width="260">
</p>

<h1 align="center">Store Virtual ADAVAM</h1>

<p align="center">
  Tienda virtual (ecommerce) en PHP puro con panel administrativo propio, hecha con arquitectura MVC sin framework.
</p>

---

## Vista previa

### Tienda (cliente)
![Página del cliente](public/img/home.png)

### Panel administrativo
![Página del admin](public/img/admin.png)

---

## Credenciales de acceso al panel admin

| Campo | Valor |
|---|---|
| URL | `http://localhost:8000/admin` |
| Correo | `admin@gmail.com` |
| Contraseña | `ADAVAM2026` |

> Si estas credenciales no funcionan (por ejemplo, si alguien reimportó la base de datos), puedes restablecer la contraseña directamente en la tabla `usuarios` — ver la sección [Base de datos](#base-de-datos).

---

## Requisitos previos

Antes de configurar el proyecto necesitas tener instalado:

| Herramienta | Versión mínima | Para qué se usa |
|---|---|---|
| [PHP](https://www.php.net/) | 7.4 o superior (probado en 8.5) | Ejecuta toda la aplicación |
| Extensiones de PHP | `pdo_mysql`, `mbstring`, `dom`, `gd` | Requeridas por dompdf, PHPMailer y el manejo de imágenes |
| [MySQL](https://www.mysql.com/) o MariaDB | 8.0+ | Base de datos |
| [Composer](https://getcomposer.org/) | 2.x | Instala las dependencias PHP (`dompdf`, `phpmailer`) |

### Instalar en macOS

La forma más simple es con [Homebrew](https://brew.sh/):

```bash
brew install php mysql composer
brew services start mysql
```

### Instalar en Windows

Dos caminos, elige uno:

**Opción A — Todo en uno (recomendado para empezar rápido):** instala [Laragon](https://laragon.org/) o [XAMPP](https://www.apachefriends.org/), que traen PHP + MySQL + Apache juntos, listos para usar. Con Apache ya incluido no necesitas el paso del `router.php` (ver más abajo): solo copia el proyecto dentro de `www/` (Laragon) o `htdocs/` (XAMPP).

**Opción B — Instalar cada herramienta por separado:**
1. PHP: descarga la versión "Thread Safe" desde [windows.php.net/download](https://windows.php.net/download/) y agrega la carpeta al `PATH`.
2. MySQL: instala con el [MySQL Installer](https://dev.mysql.com/downloads/installer/) oficial.
3. Composer: descarga e instala [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe) (detecta tu PHP automáticamente).

Verifica que todo quedó accesible desde la terminal (PowerShell o CMD):

```powershell
php -v
mysql --version
composer -V
```

---

## Configuración desde cero (guía para Dev Junior)

### 1. Clonar el proyecto e instalar dependencias

```bash
cd store-virtual-with-php
composer install
```

Esto crea la carpeta `vendor/` con las librerías `dompdf` (generación de PDFs/tickets) y `phpmailer` (envío de correos).

### 2. Crear la base de datos

Crea una base de datos vacía (el nombre puedes elegirlo, aquí usamos `store_adavam` de ejemplo) e importa el dump incluido:

```bash
mysql -u root -e "CREATE DATABASE store_adavam CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
mysql -u root store_adavam < ecommerce.sql
```

Esto crea las 6 tablas del sistema (ver [Base de datos](#base-de-datos)) con datos de ejemplo (categorías, productos y un usuario admin).

### 3. Configurar la conexión

Edita [`Config/Config.php`](Config/Config.php) con tus datos:

```php
const BASE_URL = "http://localhost:8000/";   // URL donde vas a correr el proyecto
const HOST = "localhost";
const USER = "root";                          // tu usuario de MySQL
const PASS = "";                              // tu contraseña de MySQL
const DB = "store_adavam";                    // el nombre que le diste a la BD en el paso 2
const TITLE = "STORE VIRTUAL ADAVAM";
const MONEDA = "USD";
const CLIENT_ID = "";                         // Client ID de PayPal (opcional, ver nota abajo)
```

> **PayPal (opcional):** el checkout público tiene un botón de PayPal que solo funciona si llenas `CLIENT_ID`. Si lo dejas vacío, los clientes igual pueden pagar subiendo un comprobante de transferencia/depósito (ver flujo de `Registro::registrarPedidoManual`), que es el método pensado para Ecuador/Latinoamérica.

### 4. Levantar el servidor local

El proyecto usa `.htaccess` (para Apache) para convertir URLs bonitas como `principal/productos` en `index.php?url=principal/productos`. Si usas el servidor embebido de PHP (no Apache), necesitas un `router.php` que simule esa reescritura, porque el servidor de PHP no lee `.htaccess`:

```php
<?php
// router.php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;
if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}
$_GET['url'] = ltrim($path, '/');
require __DIR__ . '/index.php';
```

Luego corre, según tu sistema operativo y terminal:

**macOS / Linux (bash o zsh):**
```bash
PHP_CLI_SERVER_WORKERS=4 php -S localhost:8000 router.php
```

**Windows (PowerShell):**
```powershell
$env:PHP_CLI_SERVER_WORKERS=4
php -S localhost:8000 router.php
```

**Windows (CMD):**
```cmd
set PHP_CLI_SERVER_WORKERS=4
php -S localhost:8000 router.php
```

> El flag `PHP_CLI_SERVER_WORKERS=4` es importante: por defecto el servidor de PHP atiende **una sola petición a la vez**, así que generar un PDF (ticket de venta) dejaría todo el sitio congelado unos segundos para cualquiera que lo esté usando. Con 4 workers, el servidor atiende varias peticiones en paralelo.

Si vas a usar **Apache** en su lugar (Laragon, XAMPP, MAMP, hosting real), no necesitas `router.php` ni el comando de arriba: solo pon el proyecto en el `htdocs`/`www` y el `.htaccess` ya incluido hace el trabajo.

### 5. Abrir el proyecto

- Tienda: `http://localhost:8000/`
- Admin: `http://localhost:8000/admin` (credenciales arriba)

---

## Estructura del proyecto

Es un **MVC hecho a mano** (sin framework): [`index.php`](index.php) es el único punto de entrada, lee la URL (`controlador/metodo/parametro`), instancia el controlador correspondiente desde `Controllers/` y este llama a su modelo (`Models/`) y renderiza una vista (`Views/`).

```
Config/            → Configuración, conexión a BD (PDO), autoload, helpers globales
Controllers/       → Un archivo por "sección" del sistema
Models/            → Uno por controlador, con las consultas SQL (extiende de Query/Conexion)
Views/
  ├─ template/      → header.php / footer.php (cliente) y header-admin.php / footer-admin.php (admin)
  ├─ principal/     → páginas públicas de la tienda
  └─ admin/         → páginas del panel administrativo
Librerias/         → Cart.php (carrito de compras en sesión, librería de terceros)
public/            → CSS, JS, e imágenes (productos, categorías, comprobantes subidos, logo)
vendor/            → dependencias de Composer (dompdf, phpmailer)
```

### Parte del cliente (tienda pública)

Controlador principal: [`Controllers/Principal.php`](Controllers/Principal.php). Vistas en `Views/principal/`.

| Página | Ruta | Vista |
|---|---|---|
| Inicio | `/` | `Views/index.php` |
| Listado de productos | `principal/productos` | `productos.php` |
| Categoría | `principal/categoria/{nombre}` | `categorias.php` |
| Detalle de producto | `principal/producto/{id}-{slug}` | `producto.php` |
| Carrito | `principal/carrito` | `carrito.php` |
| Checkout (dirección) | `principal/address` | `address.php` |
| Checkout (pago) | `principal/pagos` | `pagos.php` |
| Perfil / mis pedidos | `profile` | `profile.php` |

**Login/registro** es un modal (Bootstrap) que vive en `Views/template/header.php` y se abre desde cualquier página — no es una página aparte. Usa `Controllers/Registro.php` (registro y checkout) y `Controllers/Profile.php` (login y datos de cuenta).

**Flujo de compra:** carrito → login/registro (modal) → dirección de envío → pago. El pago admite dos caminos:
- **PayPal** (requiere `CLIENT_ID` configurado).
- **Comprobante manual** (subida de imagen de transferencia/depósito) — pensado para Ecuador, vía `Controllers/Registro.php::registrarPedidoManual()`. Queda como pedido "pendiente" hasta que el admin lo aprueba.

### Parte del admin (panel administrativo)

Todas las vistas comparten `Views/template/header-admin.php` / `footer-admin.php` (sidebar + topbar). Un controlador por sección:

| Sección | Controlador | Para qué |
|---|---|---|
| Dashboard | `Admin.php` | Login del admin y estadísticas (`admin/home`) |
| Categorías | `Categorias.php` | CRUD de categorías |
| Productos | `Productos.php` | CRUD de productos, imágenes, stock |
| Negocio | `Negocio.php` | Datos de la empresa y SMTP (para envío de correos) |
| Usuarios | `Usuarios.php` | Cuentas con acceso al admin, perfil propio |
| Clientes | `Clientes.php` | Clientes registrados en la tienda |
| Pedidos | `Pedidos.php` | Pedidos hechos desde la tienda online (aprobar / ver comprobante) |
| Ventas | `Ventas.php` | Punto de venta (POS) para ventas presenciales + historial + ticket en PDF |

**Pedidos vs. Ventas:** ambos guardan filas en la misma tabla `ventas`, pero:
- **Pedidos** = compras hechas por un cliente desde la tienda online (`tipo = 1`). El admin las revisa y las **aprueba** (botón "Aprobar"), y puede ver el comprobante de pago subido por el cliente.
- **Ventas** = ventas armadas manualmente por el admin/vendedor desde el POS (mostrador físico), que generan un ticket en PDF al completarse.

---

## Base de datos

6 tablas (ver [`ecommerce.sql`](ecommerce.sql) para el esquema completo):

| Tabla | Para qué | Relaciones clave |
|---|---|---|
| `categorias` | Categorías de productos | — |
| `productos` | Catálogo, precio, stock, imagen | `id_categoria` → `categorias.id` |
| `usuarios` | Clientes y administradores en una sola tabla | `tipo`: `1` = admin, `2` = cliente |
| `ventas` | Cabecera de cada venta/pedido (online y POS) | `id_usuario` → `usuarios.id` |
| `detalle_ventas` | Líneas de producto de cada venta | `id_venta` → `ventas.id`, `id_producto` → `productos.id` |
| `configuracion` | Datos de la empresa + credenciales SMTP | fila única (id=1) |

Columnas importantes de `ventas` para entender el flujo de pedidos:
- `tipo`: `1` = pedido online, otro valor = venta de POS.
- `proceso`: `1` = pendiente de aprobar, `2` = aprobado/completado.
- `transaccion`: id de la transacción de PayPal, o el texto `COMPROBANTE` si fue pago manual.
- `comprobante`: nombre del archivo de imagen subido como comprobante de pago (se guarda en `public/img/comprobantes/`).

Para restablecer la contraseña de un usuario admin manualmente:

```sql
-- genera el hash en PHP: php -r "echo password_hash('tu-clave-nueva', PASSWORD_DEFAULT);"
UPDATE usuarios SET clave = '<hash-generado>' WHERE correo = 'admin@gmail.com';
```

---

## Stack técnico

- **Backend:** PHP puro (MVC propio, sin framework), PDO para la base de datos.
- **Frontend:** Bootstrap 4 (tienda) y un theme de dashboard aparte (admin), jQuery, DataTables.
- **PDF:** [dompdf](https://github.com/dompdf/dompdf) para tickets de venta.
- **Correo:** [PHPMailer](https://github.com/PHPMailer/PHPMailer) para recuperación de contraseña.
- **Base de datos:** MySQL / MariaDB.
