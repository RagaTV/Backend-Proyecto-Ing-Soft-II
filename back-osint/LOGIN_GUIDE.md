# Guía del Sistema de Login

## Archivos Creados

1. **AuthController.php** - Controlador de autenticación
2. **login.html** - Página de inicio de sesión
3. **dashboard.html** - Página principal después del login

## Rutas API

### POST /api/login
Autentica un usuario y devuelve un token.

**Request:**
```json
{
    "usuario": "admin",
    "contrasena": "admin123"
}
```

**Response exitoso (200):**
```json
{
    "success": true,
    "message": "Login exitoso",
    "data": {
        "token": "base64_encoded_token",
        "usuario": {
            "id": 1,
            "nombre": "Administrador",
            "usuario": "admin",
            "mail": "admin@osint.com",
            "rol": "admin",
            "ultima_conexion": "2025-11-26 22:00:00"
        }
    }
}
```

**Response error (401):**
```json
{
    "success": false,
    "message": "Credenciales incorrectas"
}
```

**Response usuario inactivo (403):**
```json
{
    "success": false,
    "message": "Usuario inactivo. Contacte al administrador"
}
```

### POST /api/logout
Cierra la sesión del usuario.

**Response (200):**
```json
{
    "success": true,
    "message": "Logout exitoso"
}
```

### POST /api/verify
Verifica si un token es válido.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Token válido"
}
```

## Usuarios de Prueba

Según el seeder, estos son los usuarios disponibles:

1. **Administrador**
   - Usuario: `admin`
   - Contraseña: `admin123`
   - Rol: admin
   - Estado: activo

2. **Juan Pérez**
   - Usuario: `jperez`
   - Contraseña: `password123`
   - Rol: consultor
   - Estado: activo

3. **María García**
   - Usuario: `mgarcia`
   - Contraseña: `password123`
   - Rol: capturista
   - Estado: activo

4. **Carlos López**
   - Usuario: `clopez`
   - Contraseña: `password123`
   - Rol: consultor
   - Estado: activo

5. **Ana Martínez**
   - Usuario: `amartinez`
   - Contraseña: `password123`
   - Rol: admin
   - Estado: **inactivo** (no puede iniciar sesión)

## Cómo Usar

### 1. Acceder al Login
Abre tu navegador y ve a:
```
http://localhost:8000/login.html
```

### 2. Iniciar Sesión
- Ingresa el usuario o email
- Ingresa la contraseña
- Haz clic en "Iniciar Sesión"

### 3. Después del Login
- Se guarda el token en localStorage
- Se redirige automáticamente a dashboard.html
- El nombre del usuario aparece en la barra superior

### 4. Cerrar Sesión
- Haz clic en "Cerrar Sesión" en la barra superior
- Se limpia el localStorage
- Se redirige al login

## Probar con cURL

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"usuario":"admin","contrasena":"admin123"}'
```

### Logout
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Content-Type: application/json"
```

## Probar con Postman

1. **Login**
   - Method: POST
   - URL: `http://localhost:8000/api/login`
   - Body (JSON):
     ```json
     {
         "usuario": "admin",
         "contrasena": "admin123"
     }
     ```

2. **Logout**
   - Method: POST
   - URL: `http://localhost:8000/api/logout`

## Características de Seguridad

1. **Validación de campos** - Usuario y contraseña son obligatorios
2. **Verificación de contraseña** - Usa Hash::check() para comparar
3. **Usuario activo** - Solo usuarios activos pueden iniciar sesión
4. **Última conexión** - Se actualiza automáticamente al hacer login
5. **Token de sesión** - Se genera un token único por sesión

## Mejoras Futuras Recomendadas

1. Implementar Laravel Sanctum o Passport para tokens más seguros
2. Agregar rate limiting para prevenir ataques de fuerza bruta
3. Implementar recuperación de contraseña
4. Agregar autenticación de dos factores (2FA)
5. Implementar refresh tokens
6. Agregar logs de intentos de login fallidos

## Iniciar el Servidor

Para probar el login, inicia el servidor de Laravel:

```bash
php artisan serve
```

Luego accede a: `http://localhost:8000/login.html`
