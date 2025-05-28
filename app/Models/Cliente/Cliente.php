<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $siaf_status
 * @property string $razon_social
 * @property string $nombre_cliente
 * @property string $grupo
 * @property string $dias_credito
 * @property float $costo_estadia
 * @property float $costo_km
 * @property string $observaciones
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property User $user
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property ClienteContactoFacturacion[] $clienteContactoFacturacions
 * @property ClienteContactoOperativo[] $clienteContactoOperativos
 */
class Cliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente';

    /**
     * @var array
     */
    protected $fillable = ['siaf_status', 'razon_social', 'nombre_cliente', 'grupo', 'dias_credito', 'costo_estadia', 'costo_km', 'observaciones', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

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

    public function clienteContactoFacturacions()
    {
        return $this->hasMany('App\Models\Cliente\ClienteContactoFacturacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ClienteContactoOperativo()
    {
        return $this->hasMany('App\Models\Cliente\ClienteContactoOperativo');
    }
}
