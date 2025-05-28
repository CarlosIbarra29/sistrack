<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $siaf_status
 * @property string $nombre_contacto
 * @property integer $telefono_contacto
 * @property string $email_contacto
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property Cliente $cliente
 * @property User $user
 * @property SiafStatus $siafStatus
 * @property User $user
 */
class ClienteContactoFacturacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente_contacto_facturacion';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'siaf_status', 'nombre_contacto', 'telefono_contacto', 'email_contacto', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente\Cliente');
    }

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
    
}
