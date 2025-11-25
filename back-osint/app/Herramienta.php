<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $table = 'herramientas';
    protected $primaryKey = 'id_herramienta';
    public $timestamps = false;
    
    protected $fillable = ['nombre', 'enlace'];
    
    public function categorias()
    {
        return $this->belongsToMany(
            CategoriaHerramienta::class,
            'rel_herramientas_categorias',
            'id_herramienta',
            'id_categoria'
        );
    }
}
