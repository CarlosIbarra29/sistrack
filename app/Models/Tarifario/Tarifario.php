<?php

namespace App\Models\Tarifario;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $siaf_status_id
 * @property string $origen
 * @property string $destino
 * @property integer $kms
 * @property float $ppkm_sis
 * @property float $ppkm_cust
 * @property float $caseta
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property User $user
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property Cliente $cliente
 */
class Tarifario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tarifario';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'siaf_status', 'origen', 'destino', 'kms', 'ppkm_sis', 'ppkm_cust', 'caseta', 'monto_cliente', 'monto_custodio', 'subtotal', 'ganancia', 'porcentaje_custodio', 'porcentaje_sisprotec', 'total', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at', 'observaciones'];

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

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente\Cliente');
    }
}
