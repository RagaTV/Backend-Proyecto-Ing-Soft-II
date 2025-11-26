# Cómo Usar el Sistema de Login

## Paso 1: Iniciar el Servidor

Abre una terminal en la carpeta `back-osint` y ejecuta:

```bash
php artisan serve
```

El servidor se iniciará en: `http://localhost:8000`

## Paso 2: Acceder al Login

Abre tu navegador y ve a:

```
http://localhost:8000/login.html
```

## Paso 3: Iniciar Sesión

Usa estas credenciales de prueba:

**Usuario:** `admin`  
**Contraseña:** `admin123`

O también puedes usar:

**Usuario:** `jperez`  
**Contraseña:** `password123`

## Paso 4: ¡Listo!

Después de iniciar sesión, serás redirigido al dashboard.

---

## Probar la API directamente

Si quieres probar la API sin la interfaz, usa este comando:

```bash
curl -X POST http://localhost:8000/api/login -H "Content-Type: application/json" -d "{\"usuario\":\"admin\",\"contrasena\":\"admin123\"}"
```

## Usuarios Disponibles

| Usuario | Contraseña | Rol | Estado |
|---------|-----------|-----|--------|
| admin | admin123 | admin | activo |
| jperez | password123 | consultor | activo |
| mgarcia | password123 | capturista | activo |
| clopez | password123 | consultor | activo |
| amartinez | password123 | admin | inactivo ❌ |

**Nota:** El usuario `amartinez` está inactivo y no podrá iniciar sesión.
