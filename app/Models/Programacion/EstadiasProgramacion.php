<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_id
 * @property string $nombre_conductor
 * @property string $telefono
 * @property string $placas
 * @property string $generales_unidad
 * @property string $fechahora_llegada_custodio
 * @property string $fechahora_inicio_trayecto
 * @property string $fechahora_llegado_destino
 * @property string $fechahora_finalizacion
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property Programacion $programacion
 * @property User $user
 * @property User $user
 */
class EstadiasProgramacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion_estadias';

    /**
     * @var array
     */
    protected $fillable = ['programacion_id', 'nombre_conductor', 'telefono', 'placas', 'generales_unidad', 'fechahora_llegada_custodio', 'fechahora_inicio_trayecto', 'fechahora_llegado_destino', 'fechahora_finalizacion', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated', 'linea_transportistas'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacion()
    {
        return $this->hasMany('App\Models\Programacion\Programacion');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
}
