<?php

namespace App\Models\Notificaciones;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_cliente_id
 * @property integer $siaf_status_id
 * @property string $modulo_notificacion
 * @property integer $estatus
 * @property integer $op_modulo
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property ProgramacionCliente $programacionCliente
 * @property User $user
 */
class Notificaciones extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['programacion_cliente_id', 'siaf_status_id', 'modulo_notificacion', 'estatus', 'op_modulo', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated', 'resumen'];

    public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'siaf_status');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }

    public function programacionCliente()
    {
        return $this->belongsTo('App\Models\Programacion\ProgramacionCliente');
    }


}
