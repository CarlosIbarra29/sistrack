<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $cliente_tipo_documento_id
 * @property string $documento
 * @property string $mime_type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property Cliente $cliente
 * @property User $user
 * @property ClienteTipoDocumento $clienteTipoDocumento
 * @property User $user
 */
class DocumentoCliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente_documento';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'cliente_tipo_documento_id', 'documento', 'mime_type', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente\Cliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clienteTipoDocumento()
    {
        return $this->belongsTo('App\Models\Cliente\TipoDocumentoC');
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
