<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $tarifario_id
 * @property integer $custodio_id
 * @property integer $programacion_estatus_id
 * @property integer $op_monitoreo_id
 * @property integer $siaf_status
 * @property string $folio
 * @property integer $tipo_servicio
 * @property string $fecha_servicio
 * @property integer $acompanantes
 * @property string $dom_origen
 * @property string $dom_destino
 * @property string $observaciones
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property User $user
 * @property Cliente $cliente
 * @property ProgramacionEstatus $programacionEstatus
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property Custodio $custodio
 * @property ProgramacionMonitoreo $programacionMonitoreo
 * @property Tarifario $tarifario
 * @property ProgramacionAcompanante[] $programacionAcompanantes
 * @property ProgramacionEstadia[] $programacionEstadias
 */
class Programacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'tarifario_id', 'custodio_id', 'programacion_estatus_id', 'op_monitoreo_id', 'siaf_status', 'folio', 'tipo_servicio', 'fecha_servicio', 'acompanantes', 'dom_origen', 'dom_destino', 'observaciones', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente\Cliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacionEstatus()
    {
        return $this->belongsTo('App\Models\Programacion\EstatusProgramacion');
    }

    public function custodio()
    {
        return $this->belongsTo('App\Models\Custodio\Custodio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarifario()
    {
        return $this->belongsTo('App\Models\Tarifario\Tarifario');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }

    public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'siaf_status');
    }
    
    public function programacionMonitoreo()
    {
        return $this->belongsTo('App\Models\Programacion\MonitoreoProgramacion', 'op_monitoreo_id');
    }

}
