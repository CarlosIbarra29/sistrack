<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_id
 * @property string $linea_transportista
 * @property string $nombre_conductor
 * @property string $telefono
 * @property string $placas
 * @property string $generales_unidad
 * @property string $fecha_hora_llegada_custodio
 * @property string $fecha_hora_inicio_trayecto
 * @property string $fecha_hora_llegada_destino
 * @property string $fecha_hora_finalizacion
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property User $user
 * @property Programacion $programacion
 * @property User $user
 */
class DatosMonitoreoProgramacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion_datos_monitoreo';

    /**
     * @var array
     */
    protected $fillable = ['programacion_id', 'linea_transportista', 'nombre_conductor', 'telefono', 'placas', 'generales_unidad', 'fecha_hora_llegada_custodio', 'fecha_hora_inicio_trayecto', 'fecha_hora_llegada_destino', 'fecha_hora_finalizacion', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    public function programacion()
    {
        return $this->belongsTo('App\Models\Programacion\Programacion');
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
