<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $ubicacion_origen
 * @property string $direccion_origen
 * @property string $ubicacion_destino
 * @property string $direccion_destino
 * @property string $fechahora_servicio
 * @property integer $armada
 * @property string $linea_transporte
 * @property string $nombre_operador
 * @property string $placas
 * @property string $numero_telefono
 * @property string $observaciones
 * @property integer $estatus
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property User $user
 * @property User $user
 */
class Programacioncliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion_cliente';

    /**
     * @var array
     */
    protected $fillable = ['ubicacion_origen', 'direccion_origen', 'ubicacion_destino', 'direccion_destino', 'fechahora_servicio', 'armada', 'linea_transporte', 'nombre_operador', 'placas', 'numero_telefono', 'observaciones', 'estatus', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
}
