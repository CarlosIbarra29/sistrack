<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $siaf_status
 * @property string $tipo_documento
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property User $user
 */
class DocumentacionCustodio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_documentacion';

    /**
     * @var array
     */
    protected $fillable = ['siaf_status', 'tipo_documento', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

    
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
