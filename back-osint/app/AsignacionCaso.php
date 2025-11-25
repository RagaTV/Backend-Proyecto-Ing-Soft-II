<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionCaso extends Model
{
    protected $table = 'asignaciones_casos';
    protected $primaryKey = 'id_asignacion';
    public $timestamps = false;
    
    protected $fillable = ['id_usuario', 'id_caso'];
    
    protected $casts = [
        'fecha_asignacion' => 'datetime',
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
    
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'id_caso', 'id_caso');
    }
}
