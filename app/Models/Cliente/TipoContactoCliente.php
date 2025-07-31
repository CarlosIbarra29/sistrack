<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $tipo_contacto
 * @property ClienteContactoOperativo[] $clienteContactoOperativos
 */
class TipoContactoCliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente_tipo_contacto';

    /**
     * @var array
     */
    protected $fillable = ['tipo_contacto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clienteContactoOperativos()
    {
        return $this->hasMany('App\Models\Cliente\ClienteContactoOperativo', 'id_tipo_contacto');
    }
}
