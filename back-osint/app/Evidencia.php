<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $table = 'evidencias';
    protected $primaryKey = 'id_evidencia';
    public $timestamps = false;
    
    protected $fillable = ['id_caso', 'tipo', 'descripcion'];
    
    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];
    
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'id_caso', 'id_caso');
    }
}
