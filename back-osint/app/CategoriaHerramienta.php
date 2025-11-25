<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaHerramienta extends Model
{
    protected $table = 'categorias_herramientas';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    
    protected $fillable = ['nombre'];
    
    public function herramientas()
    {
        return $this->belongsToMany(
            Herramienta::class,
            'rel_herramientas_categorias',
            'id_categoria',
            'id_herramienta'
        );
    }
}
