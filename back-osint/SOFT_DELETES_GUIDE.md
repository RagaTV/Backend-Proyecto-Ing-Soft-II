# Guía de Soft Deletes (Bajas Lógicas)

## ¿Qué es Soft Delete?

Soft Delete permite "eliminar" registros sin borrarlos físicamente de la base de datos. En lugar de eliminar el registro, se marca con una fecha en la columna `deleted_at`.

## Modelos con Soft Deletes

Los siguientes modelos tienen habilitado Soft Deletes:
- Usuario
- Caso
- Herramienta
- CategoriaHerramienta
- Evidencia
- ActividadCaso
- AsignacionCaso

## Ejemplos de Uso

### Eliminar un registro (Soft Delete)
```php
$usuario = Usuario::find(1);
$usuario->delete(); // Marca como eliminado, no borra físicamente
```

### Consultar solo registros activos (no eliminados)
```php
$usuarios = Usuario::all(); // Solo usuarios no eliminados
$casos = Caso::where('estado', 'activo')->get(); // Solo casos activos y no eliminados
```

### Consultar registros eliminados
```php
$usuariosEliminados = Usuario::onlyTrashed()->get();
```

### Consultar todos los registros (incluidos eliminados)
```php
$todosLosUsuarios = Usuario::withTrashed()->get();
```

### Restaurar un registro eliminado
```php
$usuario = Usuario::withTrashed()->find(1);
$usuario->restore();
```

### Eliminar permanentemente un registro
```php
$usuario = Usuario::withTrashed()->find(1);
$usuario->forceDelete(); // Elimina físicamente de la base de datos
```

### Verificar si un registro está eliminado
```php
if ($usuario->trashed()) {
    echo "El usuario está eliminado";
}
```

## Ejemplos en Controladores

### Listar usuarios activos
```php
public function index()
{
    $usuarios = Usuario::all(); // Solo usuarios activos
    return response()->json($usuarios);
}
```

### Listar usuarios eliminados
```php
public function eliminados()
{
    $usuarios = Usuario::onlyTrashed()->get();
    return response()->json($usuarios);
}
```

### Eliminar un caso
```php
public function destroy($id)
{
    $caso = Caso::findOrFail($id);
    $caso->delete(); // Soft delete
    
    return response()->json(['message' => 'Caso eliminado correctamente']);
}
```

### Restaurar un caso
```php
public function restore($id)
{
    $caso = Caso::withTrashed()->findOrFail($id);
    $caso->restore();
    
    return response()->json(['message' => 'Caso restaurado correctamente']);
}
```

### Eliminar permanentemente
```php
public function forceDestroy($id)
{
    $caso = Caso::withTrashed()->findOrFail($id);
    $caso->forceDelete(); // Elimina físicamente
    
    return response()->json(['message' => 'Caso eliminado permanentemente']);
}
```

## Relaciones con Soft Deletes

### Incluir registros eliminados en relaciones
```php
$caso = Caso::with(['evidencias' => function($query) {
    $query->withTrashed();
}])->find(1);
```

### Excluir registros eliminados de relaciones (comportamiento por defecto)
```php
$caso = Caso::with('evidencias')->find(1); // Solo evidencias no eliminadas
```

## Notas Importantes

1. Los registros con soft delete no aparecen en consultas normales
2. Puedes restaurar registros eliminados en cualquier momento
3. Para eliminar permanentemente, usa `forceDelete()`
4. La columna `deleted_at` es NULL para registros activos
5. La columna `deleted_at` contiene la fecha/hora de eliminación para registros eliminados
