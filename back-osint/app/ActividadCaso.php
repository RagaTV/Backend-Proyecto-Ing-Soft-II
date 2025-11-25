<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadCaso extends Model
{
    protected $table = 'actividades_caso';
    protected $primaryKey = 'id_actividad';
    public $timestamps = false;
    
    protected $fillable = ['id_caso', 'actividad'];
    
    protected $casts = [
        'fecha' => 'datetime',
    ];
    
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'id_caso', 'id_caso');
    }
}
