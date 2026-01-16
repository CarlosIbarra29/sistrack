<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_id
 * @property integer $estatus_viaje_id
 * @property string $imagen
 * @property string $latitude
 * @property string $longitude
 * @property string $created_at
 * @property integer $iduserCreated
 * @property Programacion $programacion
 * @property EstatusViaje $estatusViaje
 * @property User $user
 */
class BitacoraViaje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bitacora_viaje';

    /**
     * @var array
     */
    protected $fillable = ['programacion_id', 'estatus_viaje_id', 'imagen', 'latitude', 'longitude', 'created_at', 'iduserCreated'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacion()
    {
        return $this->belongsTo('App\Models\Programacion\Programacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatusViaje()
    {
        return $this->belongsTo('App\Models\Programacion\EstatusViaje');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
}
